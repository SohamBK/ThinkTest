@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Create Test</h1>
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
        <form method="POST" action="{{ url('/test') }}" enctype = 'multipart/form-data'>
          {{ csrf_field() }}
            <div class="form-group">
              <label for="test_name">Test name</label>
              <input type="text" name="test_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="time">Duration Of Test</label>
                <input type="number" name="time" class="form-control">
            </div>
            <div class="form-group">
              <label for="passing_mark">Passing Marks</label>
              <input type="number" name="passing_mark" class="form-control">
            </div>
            <div class="form-group">
              <label for="date_time">Date & Time of the Test</label>
              <input type="datetime-local" name="date_time" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                  <option  value="10">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            <button class="btn btn-primary" type="submit">Create Test</button>
        </form>
      </div>
    </div>
  </div>
@endsection