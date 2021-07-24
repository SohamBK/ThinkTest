<?php

namespace App\Http\Controllers;

use App\department;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    // public function role()
    // {
    //     if(!Gate::allows('isAdmin')){
    //         abort(403,"Sorry, You can't do this actions");
    //     }
    // }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blamable()
    {
        department::creating(function($department){
            $department->created_by = \Auth::id();
        });

        department::updating(function($department){
            $department->updated_by = \Auth::id();
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $column = $request->input('column');
        $keyword = $request->input('search');
        $status = $request->input('status');
        $departments = department::latest()->search($column,$keyword,$status)->paginate(5)->appends(['column'=>$column,
        'search'=>$keyword,'status'=>$status]);
        // return view('department.index');
        return view('department.index',['departments'=>$departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = new department();
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = new department();
        // $department = department::create($request->validate([
        //     'department_name' => 'required | min:4 | max:100 | string',
        //     'status' => 'required',
        //     ]));

        $this->validate($request, [
            'department_name' => 'required',
        ]);
        
        $department = new department;
        $department->department_name = $request->input('department_name');
        $department->status = $request->input('status');
        $department->created_by = \Auth::id();
        $department->updated_by = \Auth::id();
        $department->save();

        //return view('department.show',['department' => $department]);
        return redirect('/department')->with('success', 'Department added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(department $department)
    {
        //$department = new department;
        return view('department.show',['department'=>$department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(department $department)
    {
        return view('department.edit',['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, department $department)
    {
        $this->validate($request, [
            'department_name' => 'required',
        ]);
        //dd($department);
         //Update Department
         //$department = new department;
         $department->department_name = $request->input('department_name');
         $department->status = $request->input('status');
         $department->updated_by = \Auth::id();
         $department->save();

         return redirect('/department')->with('success', 'Department updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(department $department)
    {
        $department->delete(); 
        
        return redirect('/department')->with('success', 'Department deleted successfully');
    }
}
