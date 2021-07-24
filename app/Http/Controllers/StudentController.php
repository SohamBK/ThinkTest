<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\test;
use App\question;
use App\question_option;
use App\result;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        
        $test= Test::where('slug',$slug)->firstorFail();
        //dd($test);
        date_default_timezone_set("Asia/Calcutta");
        $current_date = date('Y-m-d H:i:s');
        $time = $test->date_time;
        $time = strtotime($time) + 3600;
        $time = date('Y-m-d H:i:s', $time);
        

            //    if(($current_date<$test->date_time))
            //     {
            //         return view('student.before_test',['test'=>$test]);
            //     }
            //    else
            //    return view('student.create',['test'=>$test]);

               if ($current_date<$test->date_time) 
               {
                    return view('student.before_test',['test'=>$test]);
               } 
               elseif ($current_date>$time) {
                    return view('student.late_test',['test'=>$test]);
               }
               else {
                    return view('student.create',['test'=>$test]);
               }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request);
        //$student = new student();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email', 
            'roll_no' => 'required | numeric',
        ]);
        $student = \App\Student::where([
            ['test_id', '=',$request->input('test_id') ],
            ['roll_no', '=', $request->input('roll_no') ],
            ['email', '=', $request->input('email')]
            ])->first();   
        //dd($student);
        if(!$student){
            $student = new student;
            $student->test_id = $request->input('test_id');
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->roll_no = $request->input('roll_no');
            $student->save();
        }
        else{
            return view('student.test_results',['student' => student::findOrfail($student->id)]);
        }
        //dd($request->input('test_id'));
        //dd($student->id);
        //$studetn->id;
        //$result = App\Result::select('*')
        // ->where('student_id', '=', $student->id)
        // ->where('question_id', '=', $question->id)
        // ->first();
        
       // dd($student);
        // if($hasAnswer == true){
        //     return view('student.test_results',['student' => student::findOrfail($student->id)]);
        // }
        // else{}
        return view('student.student_test',['test' => test::findOrfail($request->input('test_id'))],['student'=>$student]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function addResults(request $request)
    {
       //dd($request);
        $this->validate($request, [
            'student_id' => 'required | integer',
        ]);
        // $result = new result;
        // $result->student_id = $request->input('student_id');
        //{{$user->createdBy?$user->createdBy->name:'-'}}
        $questionOptions = $request->get('selected_option');
        if($questionOptions){
        foreach($questionOptions as $key => $value) {
            $result = new result;
            $result->student_id = $request->input('student_id');
            $question_option= Question_Option::where('id',$value)->firstorFail();
            $result->question_id=$question_option->question_id = $key;
            $result->option_id=$question_option->option = $value;
            if($question_option->is_correct==1)
            {
                $result->marks = 1;
            }
            else
            {
                $result->marks = 0;
            }
            $result->save(); 
        }
       
        return view('student.test_results',['student' => student::findOrfail($request->input('student_id'))]);
        }
        else{
            echo "<p align='center'> <font color=red  size='6pt'>You should try to answer all the question if possible but you atleast need to attempt one question to submit the test!</font> </p>";
        }
      

    }

    public function showResults(test $test)
    {
        return view ('student.show_results',['test'=>$test]);
    }

    public function showTestResult(student $student)
    {
        return view('student.showtestresult',['student'=>$student]);
    }
}
