@extends('layouts.app')
@section('header_content')
<style>
.table-tr:hover {
  cursor: pointer;
    box-shadow: 0px 0px 10px #747272;
    -webkit-box-shadow: 0px 0px 10px #747272;
    -moz-box-shadow: 0px 0px 10px #747272;
  } 
th {
  background-color: #99ebff;
  }
.toggle{
  margin-top:35px;
  margin-bottom: 5px;
  padding:10px;
  border:2px solid #99ebff;
  border-radius:10px;
  display:none;
}
</style>
@endsection
@section('content')
<div class="container">
   <h1>Register Admin</h1> 
   <br>
   <a href="{{ url('/user/create') }}" class="btn btn-primary" role="button" aria-pressed="true">Register Admin</a>
   <br>
   <br>
  {{-- table --}}
  <div class="container row">
  <div class="pull-left mb-2">
      <h5 style="font-weight: bolder;">Showing results {{$users->firstItem()}} to {{$users->lastItem()}} out of  {{$users->total()}} results</h5> 
  </div>
   <!-- search section start -->
   <div class="pull-right mb-2">
    <a class="btn btn-primary btn-sm mr-2" href="{{url('user/')}}" >Reset</a> 
    <button class="btn btn-primary btn-sm search">Search</button>
  </div>
  <div class="toggle">
    <form action="{{ url('user/') }}" method="get">
      {{ csrf_field() }}
      <div class="form-group">
          <label for=""><strong>Advanced Search</strong></label><br>
            <div class="form-group">
              <label>Select Column</label>
              <select class="form-control selection" name="column" required>
                <option value="">Select search column here...</option>
                <option  value="name">Name</option>
              </select>
            </div>
            <div class="search-input">
              <label for="name">Search</label>
                <input type="text" name="search" class="search-text form-control {{$errors->has('name')?'is-invalid':''}}" value="{{old('name')}}" required placeholder="keyword">
            </div>
        </div>
        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
    </form>
  </div>
</div>
  <!-- search section end -->
  <div class="table-responsive row justify-content-center">
    <table class="table table-bordered table-hover">
      <tbody>
      <tr>
        <th>#</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Mobile No.</th>
        <th>Department Name</th>
        <th>Role</th>
      </tr>
      <?php $id = $users->firstItem() ?>
      @foreach($users as $user)  
        <tr class="table-tr" data-href="{{ url('user/'.$user->id) }}">
          <td>{{$id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->mobile}}</td>
          <td>{{$user->DepartmentName?$user->DepartmentName->department_name:'-'}}</td>
          <td>{{$user->role}}</td>
        </tr>
        <?php $id++; ?>
      @endforeach
    </tbody>
  </table>
{{ $users->links() }}
{{-- table ends --}}
</div>
</div>
<script type="text/javascript">
  $(function(){
    $('.table-tr').on('click',function(){
      console.log($(this).data('href'));
      window.location = $(this).data('href');
    });
    $('.search').on('click',function(){
    $('.toggle').toggle('slide');
    });
  });
  </script>
@endsection