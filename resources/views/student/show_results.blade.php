<?php //dd($test->questions[0]);?>
<?php 
  $students = App\student::where(['test_id'=> $test->id])->get();
  //dd($students[0]);
?>
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
/* .toggle{
  margin-top:35px;
  margin-bottom: 5px;
  padding:10px;
  border:2px solid #99ebff;
  border-radius:10px;
  display:none;
} */
</style>

@endsection

@section('content')
  <div class="container">
      <h1>Test Results</h1>
      <table class="table table-hover table-bordered">
        <tbody>
        <tr>
          <th>#</th>
          <th>Student Name</th>
          <th>Roll No.</th>
          <th>Email ID</th>
          <th>Marks Obtained</th>
        </tr>
        @foreach($students as $key =>$student)
        <?php $marksObtained =0; ?>    
      <tr class="table-tr" data-href="{{ url('showtestresult/'.$student->id) }}">
            <td>{{$key+1}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->roll_no}}</td>
            <td>{{$student->email}}</td>
            @foreach($test->questions as $question)
              <?php 
                $result = App\Result::select('*')
                  ->where('student_id', '=', $student->id)
                  ->where('question_id', '=', $question->id)
                  ->first();
                  //dd($result);
              ?>
              @foreach ($question->questionOptions as $key => $question_option)
              <?php
                  if ($question_option->id == ($result ? $result->option_id : Null) && $question_option->is_correct =='1'){
                  $marksObtained += $question->mark; 
                      } 
                ?>    
              @endforeach
            @endforeach
            <td>{{$marksObtained}}</td>
          </tr>
          
        @endforeach
      </tbody>
    </table>
  </div>

  <script type="text/javascript">
    $(function(){
      $('.table-tr').on('click',function(ev){
        ev.stopPropagation();
        console.log($(this).data('href'));
        //alert('ok');
        window.location = $(this).data('href');
      });
      // $('.search').on('click',function(){
      //   $('.toggle').toggle('slide');
      // });
    });
    </script>
<div style="height: 200px">

</div>
@endsection
