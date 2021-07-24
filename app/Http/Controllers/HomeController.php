<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\test;
use App\question;
use App\question_option;
use App\result;
use App\Student;
use App\department;
use App\user;
use Gate;

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
     * @return \Illuminate\Http\Response
     */
    public function index(test $test)
    {
        $test = test::where(['status'=>test::STATUS_ACTIVE])->get();
        //dd($test[0]);
        $student = student::all();
        //dd($student[0]);
        $user = user::all();
        $userCount = $user->count();
        return view('home',['test'=>$test],['student'=>$student])->with ('userCount',$userCount);
    }
}
