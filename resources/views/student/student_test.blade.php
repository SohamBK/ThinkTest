<?php //dd($student) ?>
<?php //die($test->questions[0]); ?>
<?php //dd($test->test_name) ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
      input[type=radio],
      #mcq input[type=text] {
          display: inline-block;
          vertical-align: middle;
          margin-bottom: 8px;
      }
      input[type=radio] {
          width: 5%;
      }
      #mcq input[type=text] {
          width: 80%;
      }
      .text-left-right {
        text-align: right;
        position: relative;
      }
.left-text {
        left: 0;
        position: absolute;
      }
      .byline {
        font-size: 16px;
        color: rgba(140, 140, 140, 1);
      }
    </style>
    <script>
      //var mins = 30;  //Set the number of minutes you need
      var mins = {{$test->time}};
      var secs = mins * 60;
      var currentSeconds = 0;
      var currentMinutes = 0;
      /* 
      * The following line has been commented out due to a suggestion left in the comments. The line below it has not been tested. 
      * setTimeout('Decrement()',1000);
      */
      setTimeout(Decrement,1000); 

      function Decrement() {
          currentMinutes = Math.floor(secs / 60);
          currentSeconds = secs % 60;
          if(currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
          secs--;
          document.getElementById("timerText").innerHTML = currentMinutes + ":" + currentSeconds; //Set the element id you need the time put into.
          if(secs !== -1) setTimeout('Decrement()',1000);
          if(secs == 0){
          document.getElementById("myForm").submit();
          }
      }
    </script>
  </head>
  <body>
  <div class="container">
    <div class="row">
      <div class="col-md-10"><h1>{{$test->test_name}}</h1></div>
      <div class="col-md-2"><h3 id="timerText" style="position:fixed; text-align:center; border: 2px solid green; border-radius: 25px;padding:10px; box-shadow: 10px 10px 5px grey;  z-index: 100;"></h3></div>
    </div>
    <div class="container">
    <form name="myForm" id="myForm" method="POST" action="{{ url('/studentresult') }}" enctype = 'multipart/form-data'>
        {{ csrf_field() }}
      <div class="form-row options form-group " id="mcq">
      <input type ="hidden" name="student_id" value="{{$student->id}}">
      @foreach($test->questions as $question)
      {{-- <input type = "hidden" name = "question_id" value = "{{$question->id}}"> --}}
       {{-- <h3>{!! $question->question !!}</h3>
       <h6>Marks: {{$question->mark}}</h6> --}}
       <h3 class="text-left-right">
        <span class="left-text">{!! $question->question !!}</span>
        <span class="byline">Marks: {{$question->mark}}</span>
      </h3>
       @foreach ($question->questionOptions as $key => $question_option)
              <input type="radio" name="selected_option[{{$question->id}}]" value="{{ $question_option->id }}" id="{{$question_option->id}}">
              <label for="{{$question_option->id}}" type="text">{{old('option')?old('option'):$question_option->option}}</label>
          <br>
        @endforeach 
          <hr style="border-top: 3px double #8c8b8b;">
      @endforeach
      </div>
      <div class="col-md-6">
        <button id="submit-btn" class="btn btn-primary" type="add" style="margin-top: 15px; margin-bottom:15px;">Submit Test</button>
      </div>
    </form>
    </div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>
