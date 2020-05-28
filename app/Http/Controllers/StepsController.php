<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Score;
use App\Calculation;
use App\Grade;
use App\Pvalue;
use App\Ritvalue;
use DB;

class StepsController extends Controller
{
    public function step1(Request $request) {
        $name = $request->test;
        $test = new Test;
        $test->name = $name;
        $test->save();
        return view('step1');
    }

    public function step2() {
        $test = DB::table('tests')->latest()->first();
        $collection = fastexcel()->import('excel/test.xlsx');
        $questions = 0;
        $scores = new Score;
        $insert = [];
        foreach($collection[0] as $key => $value) {
            if($questions > 0) {
                $score = new Score;
                $score->question = $questions;
                $score->score = $value;
                $score->scores_test_id_foreign = $test->id;
                $score->save();
            }
            $questions++;
        }
        return view('step2');
    }

    public function step3(Request $request) {
        $test = DB::table('tests')->latest()->first();
        $checkCalculation = Calculation::where('calculations_test_id_foreign', $test->id)->exists();
        if(!$checkCalculation) {
            $percentageOne = $request->percentage1;
            $percentageTwo = $request->percentage2;
            $percentageThree = $request->percentage3;
            $gradeOne = $request->grade1;
            $gradeTwo = $request->grade2;
            $gradeThree = $request->grade3;
            // First calculation
            $calculation = new Calculation;
            $calculation->percentage = $percentageOne;
            $calculation->grade = $gradeOne;
            $calculation->calculations_test_id_foreign = $test->id;
            $calculation->save();
            // Second calculation
            $calculation = new Calculation;
            $calculation->percentage = $percentageTwo;
            $calculation->grade = $gradeTwo;
            $calculation->calculations_test_id_foreign = $test->id;
            $calculation->save();
            // Third calculation
            $calculation = new Calculation;
            $calculation->percentage = $percentageThree;
            $calculation->grade = $gradeThree;
            $calculation->calculations_test_id_foreign = $test->id;
            $calculation->save();
        }
        return view('step3');
    }

    // Create grades
    public function step4() {
        $test = DB::table('tests')->latest()->first();
        $checkGrades = Grade::where('grades_test_id_foreign', $test->id)->exists();
        if(!$checkGrades) {
            // Get related calculations
            $calculations = Test::find($test->id)->calculations;
            // Get related scores
            $scores = Test::find($test->id)->scores;
            // Get the test excel sheet
            $collection = fastexcel()->import('excel/test.xlsx');
            $collection = $collection->toArray();
            $rows = 0;
            foreach($collection as $key => $value) {
                if($rows > 0) {
                    $this->grade($collection[$rows], $scores, $calculations, $test->id);
                }
                $rows++;
            }
        }
        return view('step4');
    }

    // Create grades and insert in database
    public function grade($questions, $scores, $calculations, $id) {
        $column = 0;
        $studentScore = 0;
        foreach($questions as $key => $value) {
            if($column > 0) {
                $studentScore += $value;
            } else {
                $studentName = $value;
            }
            $column++;
        }
        $perc = $studentScore / $this->maxScore($scores) * $calculations[2]->percentage;
        if($perc < $calculations[0]->percentage) {
            $gradeNum = $calculations[0]->grade;
        }
        if($perc >= $calculations[0]->percentage && $perc <= $calculations[1]->percentage) {
            $gradeNum = $calculations[1]->grade / $calculations[2]->percentage * $perc;
            $gradeNum = $calculations[0]->grade + $gradeNum;
        }
        if($perc > $calculations[1]->percentage && $perc <= $calculations[2]->percentage) {
            $gradeNum = ($calculations[2]->grade - $calculations[1]->grade) / $calculations[2]->percentage * $perc;
            $gradeNum = $calculations[1]->grade + $gradeNum; 
        }
        $grade = new Grade;
        $grade->student = $studentName;
        $grade->grade = round($gradeNum, 1);
        $grade->grades_test_id_foreign = $id;
        $grade->save();
    }

    // Get maxScores
    public function maxScore($scores) {
        $scores = $scores->toArray();
        $maxScore = 0;
        foreach($scores as $score) {
            $maxScore += $score['score'];
        }
        return $maxScore;
    }

    // Create pValues
    public function step5() {
        $test = DB::table('tests')->latest()->first();
        $checkPvalues = Pvalue::where('pvalues_test_id_foreign', $test->id)->exists();
        if(!$checkPvalues) {
            $pValues = $this->pValues($test->id);
            foreach($pValues['students'] as $key => $value) {
                $pv = round($value / $pValues['test'][$key], 1);
                $pValue = new Pvalue;
                $pValue->question = $key;
                $pValue->pvalue = $pv;
                $pValue->pvalues_test_id_foreign = $test->id;
                $pValue->save();
            }
        }

        return view('step5');
    }

    // Create pValues
    public function pValues($id) {
        $pValues['students'] = array();
        $pValues['test'] = array();
        $collection = fastexcel()->import('excel/test.xlsx');
        $collection = $collection->toArray();
        $rows = 0;
        foreach($collection as $key => $value) {
            if($rows > 0) {
                // Test student total scores for each question
                $column = 0;
                foreach($collection[$rows] as $ckey => $cvalue) {
                    if($rows == 1 && $ckey != 'ID') {
                        $pValues['students'][$ckey] = 0;
                    }
                }
                foreach($collection[$rows] as $calcKey => $calcValue) {
                    if($column > 0) {
                        $pValues['students'][$calcKey] += round($calcValue);
                    }
                    $column++;
                }
            } else {
                // Test total scores for each question
                $amountStudents = Test::find($id)->grades->count();
                $column = 0;
                foreach($collection[$rows] as $key => $value) {
                    if($column > 0) {
                        $pValues['test'][$key] = round($value * $amountStudents);
                    }
                    $column++;  
                }
            }
            $rows++;
        }
        return $pValues;
    }

    // Create RitValues
    // @TODO check why all number outputs are positive number +1
    public function step6() {
        $ritValues = array();
        $test = DB::table('tests')->latest()->first();
        $allGrades = Test::find($test->id)->grades;
        $gradeTotal = 0;
        $pValues = $this->pValues($test->id);
        $total = count($pValues['students']);
        $y = 0;
        foreach($allGrades as $grade) {
            $y += $grade->grade;
        }
        $y2 = $y / $total;
        $y3 = $y - $y2;
        $y4 = $y3 * $y3;
        $x = 0;
        foreach($pValues['students'] as $ykey => $yvalue) {
            $x = $yvalue;
            $x2 = $yvalue / $total;
            $x3 = $x - $x2;
            $x4 = $x3 * $x3;
            $som1 = $x3 * $y3;
            $som2 = $x4 * $y4;
            $som3 = sqrt($som2);
            $som4 = $som1 / $som3;
            $ritValue = new Ritvalue;
            $ritValue->question = $ykey;
            $ritValue->ritvalue = $som4;
            $ritValue->ritvalues_test_id_foreign = $test->id;
            $ritValue->save();
        }
        return redirect('/results');
    }

    public function results() {
        $test = DB::table('tests')->latest()->first();
        $testName = $test->name;
        // Get related calculations
        $calculations = Test::find($test->id)->calculations;
        // Get related scores
        $scores = Test::find($test->id)->scores;
        // Get related grades
        $grades = Test::find($test->id)->grades;
        // Get related pvalues
        $pValues = Test::find($test->id)->pvalues;
        // Get related ritvalues
        $ritValues = Test::find($test->id)->ritvalues;

        return view('results', compact('testName','calculations', 'scores', 'grades', 'pValues', 'ritValues'));
    }
}
