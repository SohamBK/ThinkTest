@extends('layouts.app')
@section('content')
  <div class="container">
    <h1>Update Department</h1>
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
      <form method="POST" action="{{ url('department/'.$department->id)}}" enctype = 'multipart/form-data'>
        {{ csrf_field() }}
        {{-- {{ method_field('PATCH') }} --}}
        <input type="hidden" name="_method" value="PATCH" />
          <div class="form-group">
            <label for="department_name">Departement Name</label>
            <input type="text" name="department_name" class="form-control" required value="{{old('department_name')?old('department_name'):$department->department_name}}">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
              <option  value="10">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>
  </div>
  </div>
  <div style="height: 85px">

  </div>
@endsection