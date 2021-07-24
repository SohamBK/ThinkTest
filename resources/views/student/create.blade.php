<?php //dd($test)?>
@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Personal Information about student before exam!</h1>
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
  @endif
<div class="card-body well">
<div class="card-body table-responsive p-0">
  <form method="POST" action="{{ url('/student') }}" enctype = 'multipart/form-data'>
    {{ csrf_field() }}
    <input type = "hidden" name = "test_id" value = "{{$test->id}}">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="roll_no">Roll No</label>
        <input type="number" name="roll_no" class="form-control">
  </div>
      <button class="btn btn-primary" type="submit">Start Test</button>
  </form>
</div>
</div>
  </div>
@endsection