<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Score;

class Scores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createScores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $collection = fastexcel()->import('public/excel/test.xlsx');
        $questions = 0;
        $scores = new Score;
        $checkScores = Score::find(1);
        if(!$checkScores) {
        $insert = [];
        foreach($collection[0] as $key => $value) {
            if($questions > 0) {
                $insert['question_'.$questions] = $value;
            }
            $questions++;
        }
        Score::insert($insert);
        $this->info('Scores are generated!');
        }
    }
}
