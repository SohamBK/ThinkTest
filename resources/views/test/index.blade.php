<?php //dd($tests); ?>
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
    <h1>Tests</h1>
    <br>
    <a href="{{ url('/test/create') }}" class="btn btn-primary" role="button" aria-pressed="true">Create Test</a>
    <br>
    <br>
    {{-- table --}}
<div class="container row">
  <div class="pull-left mb-2">
    <h5 style="font-weight: bolder;">Showing results {{$tests->firstItem()}} to {{$tests->lastItem()}} out of {{$tests->total()}} results</h5>
  </div> 
  <!-- search section start -->
  <div class="pull-right mb-2">
    <a class="btn btn-primary btn-sm mr-2" href="{{url('test/')}}" >Reset</a> 
    <button class="btn btn-primary btn-sm search">Search</button>
  </div>
  <div class="toggle">
    <form action="{{ url('test/') }}" method="get">
      {{ csrf_field() }}
      <div class="form-group">
          <label>Advanced Search</label><br>
            <div class="form-group">
              <label>Select Column</label>
              <select class="form-control selection" name="column" required>
                <option value="">Select search column here...</option>
                <option  value="test_name">Name</option>
                <option  value="date_time">Date & Time</option>
                <option  value="time">Duration of test</option>
                <option  value="mark">Passing marks</option>
              </select>
            </div>
            <div class="search-input">
              <label for="name">Search</label>
                <input type="text" name="search" class="search-text form-control {{$errors->has('test_name')?'is-invalid':''}}" value="{{old('test_name')}}" required placeholder="keyword">
            </div>
        </div>
        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
    </form>
  </div>
</div>
  <!-- search section end -->
  <div class="table-responsive row">
  <table class="table table-hover table-bordered">
    <tbody>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Test Duration (in minutes)</th>
      <th>Date & Time of Test</th>
      <th>Passing Marks</th>
      <th>Status</th>
    </tr>
    <?php $id = $tests->firstItem() ?>
    @foreach($tests as $test)
      <tr class="table-tr" data-href="{{ url('test/'.$test->id) }}">
        <td>{{$id}}</td>
        <td>{{$test->test_name}}</td>
        <td>{{$test->time}}</td>
        <td>{{$test->date_time}}</td>
        <td>{{$test->passing_mark}}</td>
        <td><?php echo App\test::$status[$test->status]; ?></td>
      </tr>
      <?php $id++; ?>
    @endforeach
  </tbody>
</table>
{{ $tests->links() }}
{{-- table ends --}}
  </div>
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