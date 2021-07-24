<?php //echo dd($user) ?>
@extends('layouts.app')
@section('header_content')
<style>
th {
  background-color: #99ebff;
  }
</style>
@endsection
@section('content')
  <div class="container">
    <h2>View User</h2>
    <br>
    <div class="row">
      <div class="col-md-1 col-xs-3">
          <form method="post" action="{{ url('user/'.$user->id)}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
              <input type="submit" onclick="return confirm('Are you sure, you want to delete this User?')" class="btn btn-danger" value="Delete"/>
          </form>
      </div>
      <div class="col-md-1 col-xs-3">     
        <form method="get" action="{{ url('user/'.$user->id.
        '/edit') }}">
            <input type="submit" class="btn btn-success" value="Update"/>
        </form>
    </div>
    </div>
    <br>
    {{-- table starts --}}
    
    <div class="card-body p-0">
      <table class="table table-condensed table-bordered">
        <tbody><tr>
          <th>Name</th>
          <th>Detail</th>
        </tr>
        <tr>
          <td>User Id</td>
          <td>
            <div class="">
              {{$user->id}}
            </div>
          </td>
        </tr>
        <tr>
          <td>User Name</td>
          <td>
            <div class="">
              {{$user->name}}
            </div>
          </td>
        </tr>
        <tr>
          <td>User Email</td>
          <td>
            <div class="">
              {{$user->email}}
            </div>
          </td>
        </tr>
        <tr>
          <td>User Mobile</td>
          <td>
            <div class="">
              {{$user->mobile}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Department Name</td>
          <td>
            <div class="">
              {{$user->DepartmentName?$user->DepartmentName->department_name:'-'}}}}
            </div>
          </td>
        </tr>
        <tr>
          <td>User Role</td>
          <td>
            <div class="">
              {{$user->role}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Created At</td>
          <td>
            <div class="">
              {{$user->created_at}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Updated At</td>
          <td>
            <div class="">
              {{$user->updated_at}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Created By</td>
          <td>
            <div class="">
              {{$user->createdBy?$user->createdBy->name:'-'}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Updated By</td>
          <td>
            <div class="">
              {{$user->updatedBy?$user->updatedBy->name:'-'}}
            </div>
          </td>
        </tr>
      </tbody></table>
    </div>

    {{-- table ends --}}
  
@endsection