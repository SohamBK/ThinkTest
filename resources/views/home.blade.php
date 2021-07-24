<?php //$test = test::where(['status'=>test::STATUS_ACTIVE])->get();?>
<?php //dd($test->count());?>
<?php $newtests = DB::table('tests')->latest()->limit(10)->get();
//dd($last[2]);
?>

@extends('layouts.app')
@section('header_content')
{{-- font aswensome link --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        body{
    /* margin-top:20px; */
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

.table-tr:hover {
  cursor: pointer;
    box-shadow: 0px 0px 10px #747272;
    -webkit-box-shadow: 0px 0px 10px #747272;
    -moz-box-shadow: 0px 0px 10px #747272;
}

th {
  background-color: #99ebff;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{-- <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div> --}}
            {{-- Dashbord cards starts --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Test</h6>
                                <h2 class="text-right"><i class="fa fa-list f-left" aria-hidden="true"></i><span>{{$test->count()}}</span></h2>
                                <p class="m-b-0">Tests Created<span class="f-right"></span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Students</h6>
                                <h2 class="text-right"><i class="fa fa-address-card f-left" aria-hidden="true"></i><span>{{$student->count()}}</span></h2>
                                <p class="m-b-0">Students Registered<span class="f-right"></span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Teachers</h6>
                                <h2 class="text-right"><i class="fa fa-users f-left" aria-hidden="true"></i><span>{{$userCount}}</span></h2>
                                <p class="m-b-0">Teachers Registered<span class="f-right"></span></p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Orders Received</h6>
                                <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>486</span></h2>
                                <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- Dashboard card ends --}}
        </div>
    </div>
    {{-- test table --}}
    <h2>Latest Tests</h2>
    <div class="table-responsive row">
    <table class="table table-hover table-bordered table-responsive">
        <tbody>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Test Duration (in minutes)</th>
          <th>Date & Time of Test</th>
          <th>Passing Marks</th>
          <th>Status</th>
        </tr>
        <?php //$id = $tests->firstItem() ?>
        @foreach($newtests as $key =>$test)
          <tr class="table-tr" data-href="{{ url('test/'.$test->id) }}">
            <td>{{$key+1}}</td>
            <td>{{$test->test_name}}</td>
            <td>{{$test->time}}</td>
            <td>{{$test->date_time}}</td>
            <td>{{$test->passing_mark}}</td>
            <td><?php echo App\test::$status[$test->status]; ?></td>
          </tr>
          <?php //$id++; ?>
        @endforeach
      </tbody>
    </table>
</div>
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
    //   $('.search').on('click',function(){
    //   $('.toggle').toggle('slide');
    //   });
    });
</script>

@endsection
