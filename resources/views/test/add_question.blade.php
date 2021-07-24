<?php //die($test->questions[1]); ?>
<?php //dd($test->test_name) ?>
@extends('layouts.app')

@section('header_content')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function (){
        $("#type").change(function() {
            // foo is the id of the other select box 
            if ($(this).val() != "1") {
                $("#mcq").hide();
            }else{
                $("#mcq").show();
            } 
        });
    });
</script>

<style>
input[type=radio],
#mcq input[type=text] {
    display: inline-block;
    vertical-align: middle;
}
input[type=radio] {
    width: 5%;
}
#mcq input[type=text] {
    width: 80%;
}
.tox-notifications-container{
  display:none;
}
th {
  background-color: #99ebff;
}
td {
  padding: 15px;
  text-align: left;
}

</style>

@endsection

@section('content')

  <div class="container">
  <H2>Add Questions to {{$test->test_name}}</H2>
    @if($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif
    <div class="card-body well">
      <div class="card-body table-responsive p-0">
        <form method="POST" action="{{ url('/addquestion') }}" enctype = 'multipart/form-data'>
          {{ csrf_field() }}
        <input type = "hidden" name = "test_id" value = "{{$test->id}}">
            <div class="form-group col-md-12">
              <label for="question">Question</label>
              <textarea name="question" class="form-control"> </textarea>
            </div>
            <div class="form-row">
              <div class="col-md-6">
                  <label>Question Type</label>
                  <select class="form-control" id="type" name="question_type" required>
                    <option  value="1">MCQ</option>
                    <option hidden value="2">Text</option>
                  </select>
              </div>
              <div class="col-md-6">
                    <label for="mark">Question Marks</label>
                    <input type="number" name="mark" class="form-control" >
              </div>
            </div>
            <div class="form-row options">
              <div class="form-group col-md-11" id="mcq">
                <br>
                <input type="radio" name="selected-option" value="1">
                <input type="text" name="option[]" class="form-control" placeholder="add option">
                <button class="btn btn-primary btn-add" type="add" style="margin-left: 12px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>
            </div>
            <div class="col-md-6">
              <button class="btn btn-primary" type="add" style="margin-top: 5px">Add question</button>
            </div>
        </form>
      </div>
    </div>
    {{-- <h1>Test questions</h1> --}}
    {{-- table 
    <h6>Note : Correct answers are highlighted in green.</h6>
    <table class="table table-hover table-tr table-bordered">
      <tbody>
      <tr>
        <th class="col-md-11">Question</th>
        <th class="col-md-1">Action</th>
      </tr>
        @foreach($test->questions as $question)
          <tr class="table-tr" >
            <td class="col-md-11">{!! $question->question !!} </td>
            <td>
            <div class="row">
              <div class="col-md-1 col-sm-1">
                  <form method="post" action="{{ url('delquestion/'.$question->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete this Question?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </form>
              </div> 
              <div class="col-md-1 col-sm-1">     
                <form method="get" action="{{ url('editquestion/'.$question->id.
                  '/edit') }}">
                  <button class="btn btn-success" style="width:35px; height:36px; margin-left:20px;"><i class="fa fa-pencil" aria-hidden="true">
                  </i></button>
                </form>
              </div>
            </div> </td>
          </tr>
          <tr class="table-tr">
            @if ($question->question_type == 2)
              <td>The answer to this question is text based.</td> 
            @else 
              @foreach($question->questionOptions as $question_option)
                @if ($question_option->is_correct == 1)
                    <td class="col-md-3">option : {{ $question_option->option }} </td>
                @else 
                  <td class="col-md-3"> option : {{ $question_option->option }} </td> 
                 
                @endif
              @endforeach 
            @endif
          </tr>
        </div>
        @endforeach
    </div>
    </tbody>
  </table>
 table ends --}}
  <div class="container">
    <h1>Test Questions</h1>
    <h6>Note : Correct option is  highlighted in green.</h6>
    <div class="container">
      @foreach($test->questions as $question)
       <h3>{!! $question->question !!}</h3>
        @foreach($question->questionOptions as $question_option)
                <ul>
                  @if ($question_option->is_correct == 1)
                      <li><h4 style="color: green; font-weight:bold">option : {{ $question_option->option }} </h4></li>
                  @else 
                    <li><h4> option : {{ $question_option->option }} </h4> </li>
                  @endif
                </ul>
                @endforeach 
                {{-- buttons starts here  --}}
                <div class="row">
                  <div class="col-md-1" >
                      <form method="post" action="{{ url('delquestion/'.$question->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onclick="return confirm('Are you sure, you want to delete this Question?')">Delete</button>
                      </form>
                  </div> 
                  <div class="col-md-1">     
                    <form method="get" action="{{ url('editquestion/'.$question->id.
                      '/edit') }}">
                      <button class="btn btn-success">Edit</button>
                    </form>
                  </div>
                </div>
                {{-- Buttons end here --}}
              <hr style="border-top: 3px double #8c8b8b;">
      @endforeach
    </div>
  </div>
  </div> 
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    $( document ).ready(function() {
      tinymce.init({selector:'textarea'});



      $('.options').on('click','.btn-add', function(e){
        e.preventDefault();

        var option_html = '<div class="form-group col-md-11" id="mcq"> <br> <input type="radio" name="selected-option" value="'+ ($('input[type="radio"]').length + 1)  +'"> <input type="text" name="option[]" class="form-control" placeholder="add option"> <button class="btn btn-primary btn-add" type="add" style="margin-left: 12px;"><i class="fa fa-plus" aria-hidden="true"></i></button> </div>';

        var delete_option = '<button class="btn btn-danger btn-remove" type="add" style="margin-left: 12px;"><i class="fa fa-minus" aria-hidden="true"></i></button>';

        $('.options').append(option_html); 
        $('.btn-remove').remove();
        $('input[type="radio"][value="'+($('input[type="radio"]').length)+'"]').parent().append(delete_option);
      });

      $('.options').on('click','.btn-remove', function(e){
        e.preventDefault();
        $(this).parent().remove();
      });

    });
  </script>
 	
     
@endsection