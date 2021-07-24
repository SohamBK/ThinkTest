<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\department;
use App\user;
use Gate;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(request $request)
    {
        $column = $request->input('column');
        $keyword = $request->input('search');
        //$status = $request->input('status');
        $users = user::latest()->search($column,$keyword)->paginate(5)->appends(['column'=>$column,
        'search'=>$keyword]);
        return view('user.index',['users'=>$users]);
        // return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = new user();

        $departments = department::where(['status'=>department::STATUS_ACTIVE])->get();
        return view('user.create',['departments'=>$departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = new user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email', 
            'mobile' => 'required | numeric',
            'department_id'=>'required',
            'password'=>'required | min:6',
        ]);
        
        $user = new user;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->department_id = $request->input('department_id');
        $user->role = $request->input('role');
        $user->password = bcrypt ($request->input('password'));
        $user->save();

        return redirect('/user')->with('success', 'Admin added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // $id romoved form show paramentes
    public function show(User $user)
    {
        // $user = new user;
        return view('user.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //removed $id from edit and replaced with user
    public function edit(User $user)
    {
        $departments = department::where(['status'=>department::STATUS_ACTIVE])->get();
        return view('user.edit',['user' => $user],['departments'=>$departments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //removed $id and replaced with user
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required | email', 
            'mobile' => 'required | numeric',
        ]);
        
        //$user = new user;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->department_id = $request->input('department_id');
        $user->role = $request->input('role');
        $user->password = bcrypt ($request->input('password'));
        $user->save();

        return redirect('/user')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // $id romoved form destroy paramentes
    public function destroy(User $user)
    {
        $user->delete(); 
        
        return redirect('/user')->with('success', 'Admin deleted successfully');
    }
}
