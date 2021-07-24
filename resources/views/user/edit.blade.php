@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Update User</h1>
    {{-- Errors --}}
    @if($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif
    {{-- Errors ends --}}
    <div class="well">
      <form method="POST" action="{{ url('user/'.$user->id)}}" enctype = 'multipart/form-data'>
        {{ csrf_field() }}
        {{-- {{ method_field('PATCH') }} --}}
        <input type="hidden" name="_method" value="PATCH" />
        <div class="form-group">
          <label for="name">Username</label>
          <input type="text" name="name" class="form-control" required value="{{old('name')?old('name'):$user->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required value="{{old('enail')?old('email'):$user->email}}">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="number" name="mobile" class="form-control" required value="{{old('mobile')?old('mobile'):$user->mobile}}">
        </div>
        {{-- department --}}
          <div class="form-group">
              <label for="department_id">Select Department</label>
              <select class="form-control department" name="department_id" required>
                <option  value="">Select Department Here...</option>
                @foreach($departments as $department)
                  <option value="{{$department->id}}">{{$department->department_name}}</option>
                @endforeach
              </select>
          </div>
      {{-- department ends --}}
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" name="role" class="form-control" required value="{{old('role')?old('role'):$user->role}}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>  
  </div>
@endsection