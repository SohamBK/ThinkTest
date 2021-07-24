
<?php //echo dd($department) ?>
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
    <h2>View Department</h2>
    <br>
      <div class="row">
        <div class="col-md-1 col-xs-3">
            <form method="post" action="{{ url('department/'.$department->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
                <input type="submit" onclick="return confirm('Are you sure, you want to delete this Department?')" class="btn btn-danger" value="Delete"/>
            </form>
        </div> 
        <div class="col-md-1 col-xs-3">     
          <form method="get" action="{{ url('department/'.$department->id.
          '/edit') }}">
              <input type="submit" class="btn btn-success" value="Update"/>
          </form>
        </div>
      </div> 
      <br>
    {{-- table starts --}}
    <div class="card-body p-0">
      <table class="table table-condensed table-bordered">
        <tbody>
          <tr>
          <th>Name</th>
          <th>Detail</th>
        </tr>
        <tr>
          <td>Department Id</td>
          <td>
            <div>
              {{$department->id}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Department Name</td>
          <td>
            <div>
              {{$department->department_name}}
            </div>
          </td>
        </tr>
         <tr>
          <td>status</td>
          <td>
            <div class="">
              {{App\department::$status[$department->status]}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Created At</td>
          <td>
            <div class="">
              {{$department->created_at}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Updated At</td>
          <td>
            <div class="">
              {{$department->updated_at}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Created By</td>
          <td>
            <div class="">
              {{$department->createdBy?$department->createdBy->name:'-'}}
            </div>
          </td>
        </tr>
        <tr>
          <td>Updated By</td>
          <td>
            <div class="">
              {{$department->updatedBy?$department->updatedBy->name:'-'}}
            </div>
          </td>
        </tr>
      </tbody></table>
    </div>
    {{-- table ends --}}
  </div>

  

@endsection