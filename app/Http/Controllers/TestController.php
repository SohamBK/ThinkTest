<?php

namespace App\Http\Controllers;

use App\test;
use App\question;
use App\question_option;
use Illuminate\Http\Request;
use Gate;
class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function blamable()
    {
        test::creating(function($test){
            $test->created_by = \Auth::id();
        });

        test::updating(function($test){
            $test->updated_by = \Auth::id();
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        //return view('test.index');
        $column = $request->input('column');
        $keyword = $request->input('search');
        $status = $request->input('status');
        $tests = test::latest()->search($column,$keyword,$status)->paginate(5)->appends(['column'=>$column,
        'search'=>$keyword,'status'=>$status]);
        return view('test.index',['tests'=>$tests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $test = new test;
        return view('test.create_test');
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
        //$test = new test;
        $this->validate($request, [
            'test_name' => 'required | string',
            'time' => 'required | integer',
            'passing_mark' => 'required | integer',
            'date_time' => 'required',
        ]);
        
        $test = new test;
        $test->test_name = $request->input('test_name');
        $test->time = $request->input('time');
        $test->date_time = $request->input('date_time');
        $test->passing_mark = $request->input('passing_mark');
        $test->status = $request->input('status');
        $test->created_by = \Auth::id();
        $test->updated_by = \Auth::id();
        //dd($test->slug = sluggable($request->test_name));
        $test->save(); 

        //$test_id = $test->id;
        // ->with('name', 'Victoria');
        // dd($test->id);
        // dd(test::findOrfail($test->id));
        return view('test.add_question',['test' => test::findOrfail($test->id)])->with('success', 'Test created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(test $test)
    {
        return view('test.show',['test'=>$test]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(test $test)
    {
        date_default_timezone_set("Asia/Calcutta");
        $current_date = date('Y-m-d H:i:s');
        if(($current_date>=$test->date_time))
                {
                    return view('student.after_test',['test'=>$test]);
                }
               else
                    return view('test.edit',['test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, test $test)
    {
        $this->validate($request, [
            'test_name' => 'required | string',
            'time' => 'required | integer',
            'passing_mark' => 'required | integer',
            'date_time' => 'required',
        ]);

         //Update Test
         $test->test_name = $request->input('test_name');
         $test->time = $request->input('time');
         $test->date_time = $request->input('date_time');
         $test->passing_mark = $request->input('passing_mark');
         $test->status = $request->input('status');
         $test->created_by = \Auth::id();
         $test->updated_by = \Auth::id();
         $test->save(); 

         return redirect('/test')->with('success', 'Test updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(test $test)
    {
        $test->delete(); 
        
        return redirect('/test')->with('success', 'Test deleted successfully');
    }

    public function addQuestion(Request $request)
    {

        //dd($request);
        $this->validate($request, [
            'test_id' => 'required | integer',
            'question' => 'required | string',
            'question_type' => 'required | integer',
            'mark' => 'required | integer',
            
        ]);

        // dd($request->input('test_id'));

        
        $question = new question;
        $question->test_id = $request->input('test_id');
        $question->question = $request->input('question');
        $question->question_type = $request->input('question_type');
        $question->mark = $request->input('mark');
        $question->created_by = \Auth::id();
        $question->updated_by = \Auth::id();
        $question->save(); 

        //dd($request);

        $options = $request->option;
        foreach($options as $key => $value) {
            $question_option = new question_option;
            
            //dd($value );
            //dd($question->id);
            //dd($request->input('selected-option'));
            $question_option->question_id = $question->id;
            $question_option->option = $value;
            $question_option->created_by = \Auth::id();
            $question_option->updated_by = \Auth::id();
            // dd($key++);

            if(++$key == $request->input('selected-option'))
            {
                $question_option->is_correct = 1;
            }
            else
            {
                $question_option->is_correct = 0;
            }
            $question_option->save();
        }
        //exit;
        return view('test.add_question',['test' => test::findOrfail($request->input('test_id'))])->with('success', 'Question added successfully');
        
    }

    public function addQuestionView($test_id)
    {
        return view('test.add_question',['test' => test::findOrfail($test_id)])->with('success', 'Question added successfully');
    }

    public function deleteQuestion(question $question)
    {
        $test_id = $question->test_id;
        foreach($question->questionOptions as $question_option)
        {
            $question_option->delete();
        }
        $question->delete();
         return view('test.add_question',['test' => test::findOrfail($test_id)])->with('success', 'Question deleted successfully');

        // return redirect('/addQuestionView',['test_id' => test::findOrfail($test_id)])->with('success', 'Question deleted successfully');

        //return redirect()->route( '/addQuestionView' )->with( [ 'test_id' => $test_id ] );
    }

    public function editQuestion(question $question)
    {
        return view('test.edit_question',['question' => $question]); 
    }

    public function updateQuestion(Request $request, question $question)
    {
         
        //dd($request);
        $this->validate($request, [
            // 'test_id' => 'required | integer',
            'question' => 'required |string',
            'question_type' => 'required | integer',
            'mark' => 'required | integer',
        ]);
        //dd($request);
        // $question = question::find()->where(['id'=>$request->input('id')])->one();
         $test_id = $question->test_id;
        // $question->test_id = $request->input('test_id');
        $question->question = $request->input('question');
        $question->question_type = $request->input('question_type');
        $question->mark = $request->input('mark');
        //$question->created_by = \Auth::id();
        $question->updated_by = \Auth::id();
        $question->save(); 

        //dd($request);
        $options = $request->option;
        //dd($options);
        $key_flag = 0;
        foreach($options as $key => $value) {
            //$question_option = new question_option;
            //$question_option->question_id = $question->id;
            $question_option = Question_Option::findorfail($key);
            $question_option->option = $value;
            $question_option->updated_by = \Auth::id();
            if($key_flag == $request->input('selected-option'))
            {
                $question_option->is_correct = 1;
            }
            else
            {
                $question_option->is_correct = 0;
            }
            $question_option->save();
            $key_flag++;
        }
        return view('test.add_question',['test' => test::findOrfail($test_id)])->with('success', 'Question updated successfully');
    }

        
}
