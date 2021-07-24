@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Update Test Details</h1>
    <br>
    @if($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif
    <div class="well">
      <form method="POST" action="{{ url('test/'.$test->id)}}" enctype = 'multipart/form-data'>
        {{ csrf_field() }}
        {{-- {{ method_field('PATCH') }} --}}
        <input type="hidden" name="_method" value="PATCH" />
        <div class="form-group">
          <label for="test_name">Test name</label>
          <input type="text" name="test_name" class="form-control" required value="{{old('test_name')?old('test_name'):$test->test_name}}">
        </div>
        <div class="form-group">
            <label for="time">Duration Of Test</label>
            <input type="number" name="time" class="form-control" required value="{{old('time')?old('time'):$test->time}}">
        </div>
        <div class="form-group">
          <label for="passing_mark">Passing Marks</label>
          <input type="number" name="passing_mark" class="form-control" required value="{{old('passing_mark')?old('passing_mark'):$test->passing_mark}}">
        </div>
        <div class="form-group">
          <label for="date_time">Date & Time of the Test</label>
          <input type="datetime-local" name="date_time" class="form-control" required value="{{old('date_time')?old('date_time'):$test->date_time}}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
              <option  value="10">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        <button class="btn btn-primary" type="submit">Update Test</button>
      </form>
    </div>
  </div>
  </div>
@endsection