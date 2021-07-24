@extends('layouts.app')

@section('content')
  <div class="container">
    @if($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif
    {{-- User registration form --}}
    <h1>Register Admin</h1>
    <div class="card-body well">
      <div class="card-body table-responsive p-0">
        <form method="POST" action="{{ url('/user') }}" enctype = 'multipart/form-data'>
          {{ csrf_field() }}
            <div class="form-group">
              <label for="name">Username</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="number" name="mobile" class="form-control">
            </div>
            {{-- department --}}
              <div class="form-group">
                  <label for="department_id">Select Department</label>
                  <select class="form-control department" name="department_id">
                    <option  value="">Select Department Here...</option>
                    @foreach($departments as $department)
                      <option value="{{$department->id}}">{{$department->department_name}}</option>
                    @endforeach
                  </select>
              </div>
          {{-- department ends --}}
            <div class="form-group">
                {{-- <label for="role">Role</label>
                <input type="text" name="role" class="form-control"> --}}
                <input class="form-control" name="role" type="hidden" value="Admin">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            {{-- <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" required>
                  <option  value="10">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div> --}}
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
    </div>

    {{-- User registration form ends --}}
  </div>
@endsection