<?php //dd($student->test->question);?>
<?php //die($student->test->questions[0]); ?>


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
        @media print {
        /* style sheet for print goes here */
        .printbutton {
          visibility: hidden;
          }
          title{
            visibility: hidden;
          }
        }
}
    </style>
  </head>
  <body>
    <div class="container">
    <h1 style="text-align: center;">Test Result</h1>
    <h1>{{$student->test->test_name}} Test</h1>
    <?php
          $marksObtained =0;    
          $totalMarks = 0;
          foreach($student->test->questions as $question)
          {
              $totalMarks+= $question->mark;
          }
          //echo $totalMarks;
          //echo "<h4> Total Marks: $totalMarks</h4>";
          //echo "<h4> Passing Marks: {$student->test->passing_mark} </h4>";
          $passing_mark = $student->test->passing_mark;
          
    ?>

    <div id="demo" class="">  
      <h2 id="pass_fail"></h2>
      <h4>You have scored <span id="marks_obtained"></span> out of {{$totalMarks}} in {{$student->test->test_name}} Test, Where passing marks were {{$student->test->passing_mark}}.</h4>
    </div>          
    @foreach($student->test->questions as $question)
    <h3 class="text-left-right">
      <span class="left-text">{!!$question->question !!}</span>
      <span class="byline">Marks: {{$question->mark}}</span>
    </h3>
          <?php 
            $result = App\Result::select('*')
                ->where('student_id', '=', $student->id)
                ->where('question_id', '=', $question->id)
                ->first();
            //dd($result);
          ?>
          <?php //exit; ?>
        @foreach ($question->questionOptions as $key => $question_option)
              <input type="radio" name="selected_option[{{$question->id}}]" value="{{ $question_option->id }}" id="{{$question_option->id}}"  {{ ( $question_option->id == ($result ? $result->option_id :Null) ? 'checked' : 'disabled') }}>
              <label for="{{$question_option->id}}" type="text" disabled>{{old('option')?old('option'):$question_option->option}}</label>
              <br>
        @endforeach 
        @foreach ($question->questionOptions as $key => $question_option)
        <?php
            if ($question_option->id == ($result ? $result->option_id : Null) && $question_option->is_correct =='1'){
                  echo "<h4 style='color:green'>The option selected is correct</h4>"; 
            $marksObtained += $question->mark; 
                } 
            elseif($question_option->id == ($result ? $result->option_id : Null) && $question_option->is_correct =='0'){
                  echo "<h4 style='color:red'>Incorrect option choosed.</h4>";
                }  
            elseif($question_option->is_correct == '1'){
                  echo "<h4 style='color:green'>Correct Option: $question_option->option </h4>";
                }           
        ?>    
        @endforeach
        <?php
        if(!$result){
          echo "<h4 style='color:red'>You did not select any option for this question.</h4>";
          }
          ?>
        <hr style="border-top: 3px double #8c8b8b;">
    @endforeach
      <div style="margin: 25px;" class="col-md-12 text-center">
        <button type="button" class=" printbutton btn btn-primary" onClick="window.print()" value="Print Test Result">Print Test Result</button>
      </div>
    </div>
    {{-- <script>
      document.getElementById("marks_obtained").innerHTML = {{$marksObtained}};
    </script> --}}
    <script>
        if ({{$marksObtained}} >= {{$passing_mark}}) {
          document.getElementById("pass_fail").innerHTML = 'Congratulations, You Pass!';
          document.getElementById("marks_obtained").innerHTML = {{$marksObtained}};
          document.getElementById("demo").setAttribute("class", "alert alert-success alert-dismissible");
        }
        else{
          document.getElementById("pass_fail").innerHTML = 'You Failed!';
          document.getElementById("marks_obtained").innerHTML = {{$marksObtained}};
          document.getElementById('demo').setAttribute("class", "alert alert-danger alert-dismissible");
        }
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
