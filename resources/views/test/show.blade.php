<?php 
  date_default_timezone_set("Asia/Calcutta");
  $current_date = date('Y-m-d H:i:s'); 
?>
@extends('layouts.app')
@section('header_content')
<style>
th {
  background-color: #99ebff;
}
::selection {
        color: none;
        background: none;
    }
</style>

@endsection
@section('content')
<div class="container">
  <h1>View Test</h1>
  <br>
  <br>
  <div class="row">
    @if($current_date>=$test->date_time)
        {{-- <h3>The test is live, so you can not make any changes!</h3> --}}
        <div class="col-md-1 col-xs-3">     
          <form method="get" action="{{ url('showresult/'.$test->id)}}">
            <input type="submit" class="btn btn-primary" value="Result"/>
          </form>
      </div>
    @else
    <div class="col-md-1 col-xs-3">
        <form method="post" action="{{ url('test/'.$test->id)}}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
            <input type="submit" onclick="return confirm('Are you sure, you want to delete this Test?')" class="btn btn-danger" value="Delete"/>
        </form>
    </div> 
    <div class="col-md-1 col-xs-3">     
      <form method="get" action="{{ url('test/'.$test->id.
      '/edit') }}">
          <input type="submit" class="btn btn-success" value="Update"/>
      </form>
  </div>
  <div class="col-md-1 col-xs-3">  
    <form method="get" action="{{ url('addquestionview/'.$test->id) }}">
        <input type="submit" class="btn btn-primary" value="Questions"/>
    </form>
  </div>
  @endif
  <div class="col-md-1 col-xs-3" > 
    &nbsp;
    &nbsp;
    <input type="submit" class="btn btn-info" data-toggle="modal" data-target="#basicModal" value="Link"/>
    {{-- modal content starts here --}}
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Test Link</h4>
          </div>
          <div class="modal-body">
            <h4 style="margin-left:8px;">Normal Test Link</h4>
              <input  type="text" size="60" style="pointer-events:none;padding: 8px ;  margin: 8px;" name="textbox1" id="myInput" value="{{ URL::to('/') . '/student/create/' . $test->slug }}"> &nbsp;
              <button class="btn btn-default btn-sm" style="display: block; margin-top:4px; margin-left:8px;" onclick="myFunction()" >
                Copy Link
                </button>
                <p id="msg" style="color: green; margin-left:8px;"></p>
            <h4 style="margin-left:8px;">Test link with description</h4>
            <textarea id="myInput2" name="textarea" style="pointer-events:none; padding: 8px ;  margin: 8px; align: left; clear:left" rows="8" cols="60">
Test Name: {{$test->test_name}}
Test Duration (in minutes): {{$test->time}} 
Date & Time of the Test: {{$test->date_time}}
Passing Marks: {{$test->passing_mark}}
Link: 
{{ URL::to('/') . '/student/create/' . $test->slug }}
            </textarea>
            <button class="btn btn-default btn-sm" style="display: block; margin-left: 8px;" onclick="myFunction2()" >
              Copy Link
              </button>
              <p id="msg2" style="color: green; margin-left:8px;"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    {{-- modal content ends here --}}
  </div>
</div>
  <br>
  {{-- table starts --}}
  <div class="card-body p-0 table-responsive">
    <table class="table table-condensed table-bordered w-auto">
      <tbody>
        <tr>
        <th>Name</th>
        <th>Detail</th>
      </tr>
      <tr>
        <td>Test Id</td>
        <td>
          <div>
            {{$test->id}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Test Name</td>
        <td>
          <div>
            {{$test->test_name}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Test Duration (in minutes)</td>
        <td>
          <div>
            {{$test->time}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Date & Time of Test</td>
        <td>
          <div>
            {{$test->date_time}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Passing Marks of Test</td>
        <td>
          <div>
            {{$test->passing_mark}}
          </div>
        </td>
      </tr>
       <tr>
        <td>Test Status</td>
        <td>
          <div class="">
            {{App\test::$status[$test->status]}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Created At</td>
        <td>
          <div class="">
            {{$test->created_at}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Updated At</td>
        <td>
          <div class="">
            {{$test->updated_at}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Created By</td>
        <td>
          <div class="">
            {{$test->createdBy?$test->createdBy->name:'-'}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Updated By</td>
        <td>
          <div class="">
            {{$test->updatedBy?$test->updatedBy->name:'-'}}
          </div>
        </td>
      </tr>
      <tr>
        <td>Test Url</td>
        <td>
          <div class="">
            <a href="">{{ URL::to('/') . '/student/' . $test->slug }}</a>
          </div>
        </td>
      </tr>
    </tbody></table>
  </div>
  {{-- table ends --}}


</div>

<script>
  function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.getElementById("msg").innerHTML = "Link Copied succesfully!";
    setTimeout(function() {
    $('#msg').html('');
  }, 5000);
    
  }
  
  

  function myFunction2() {
    var copyText = document.getElementById("myInput2");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    document.getElementById("msg2").innerHTML = "Link Copied succesfully!";
    setTimeout(function() {
    $('#msg2').html('');
  }, 5000);
    
  }
  
  
  </script>

@endsection