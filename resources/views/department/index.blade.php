<?php //echo dd($department) ?>
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
  <h1>Department</h1>
  <br>
  <a href="{{ url('/department/create') }}" class="btn btn-primary" role="button" aria-pressed="true">Add Department</a>
  <br>
  <br>
  {{-- table --}}
<div class="container row">
  <div class="pull-left mb-2">
      <h5 style=" font-weight: bolder;">Showing results {{$departments->firstItem()}} to {{$departments->lastItem()}} out of  {{$departments->total()}} results</h5> 
  </div>
  <!-- search section start -->
  <div class="pull-right mb-2">
    <a class="btn btn-primary btn-sm mr-2" href="{{url('department')}}" >Reset</a> 
    <button class="btn btn-primary btn-sm search">Search</button>
  </div>
  <div class="toggle">
    <form action="{{ url('department/') }}" method="get">
      {{ csrf_field() }}
      <div class="form-group">
          <label for=""><strong>Advanced Search</strong></label><br>
            <div class="form-group">
              <label>Select Column</label>
              <select class="form-control selection" name="column" required>
                <option value="">Select search column here...</option>
                <option  value="department_name">Name</option>
              </select>
            </div>
            <div class="search-input">
              <label for="name">Search</label>
                <input type="text" name="search" class="search-text form-control {{$errors->has('department_name')?'is-invalid':''}}" value="{{old('department_name')}}" required placeholder="keyword">
            </div>
        </div>
        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
    </form>
  </div>
</div>
  <!-- search section end -->

  <table class="table table-hover table-bordered">
    <tbody>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Status</th>
    </tr>
    <?php $id = $departments->firstItem() ?>
    @foreach($departments as $key =>$department)
      <tr class="table-tr" data-href="{{ url('department/'.$department->id) }}">
        <td>{{$id}}</td>
        <td>{{$department->department_name}}</td>
        <td><?php echo App\department::$status[$department->status]; ?></td>
      </tr>
      <?php $id++; ?>
    @endforeach
  </tbody>
</table>
{{ $departments->links() }}
{{-- table ends --}}
</div>  

<script type="text/javascript">
  $(function(){
    $('.table-tr').on('click',function(ev){
      ev.stopPropagation();
      console.log($(this).data('href'));
      //alert('ok');
      window.location = $(this).data('href');
    });
    $('.search').on('click',function(){
      $('.toggle').toggle('slide');
    });
  });
  </script>

  

@endsection