<?php

namespace App\Http\Controllers;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Score;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $test = DB::table('tests')->latest()->first();
        if($test) {
            $test = true;
        } else {
            $test = false;
        }

        return view('dashboard', compact('test'));
    }

}
