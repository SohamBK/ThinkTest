@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Add Department</h1>
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
    <form method="POST" action="{{ url('/department') }}" enctype = 'multipart/form-data'>
      {{ csrf_field() }}
        <div class="form-group">
          <label for="department_name">Departement Name</label>
          <input type="text" name="department_name" class="form-control">
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
<div style="height: 85px">

</div>
@endsection