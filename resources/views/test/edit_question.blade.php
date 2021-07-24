@extends('layouts.app')
@section('content')
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
</style>

@endsection

<?php //dd($question->questionOptions); ?>
<div class="container">
  <h2>Edit Question</h2>
  <div class="card-body well">
    <div class="card-body table-responsive p-0">
      <form method="POST" action="{{ url('updatequestion/'.$question->id)}}" enctype = 'multipart/form-data'>
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH" />
        {{-- <input type = "hidden" name = "id" value = "{{$question->id}}">
        <input type = "hidden" name = "test_id" value = "{{$question->test_id}}"> --}}
          <div class="form-group col-md-12">
            <label for="question">Question</label>
            <textarea name="question" class="form-control" required> {{old('question')?old('question'):$question->question}} </textarea>
          </div>
          <div class="form-row">
            <div class="col-md-6">
                <label>Question Type</label>
                <select class="form-control" id="type" name="question_type" required value="{{old('question_type')?old('question_type'):$question->question}}">
                  <option  value="1">MCQ</option>
                  <option hidden value="2" >Text</option>
                </select>
            </div>
            <div class="col-md-6">
                  <label for="mark">Question Marks</label>
                  <input type="number" name="mark" class="form-control" required value="{{old('mark')?old('mark'):$question->mark}}">
            </div>
          </div>
          <div class="form-row options">
            <div class="form-group col-md-11" id="mcq">
              <br>
              @foreach ($question->questionOptions as $key => $question_option)
              
                <input type="radio" name="selected-option" value="{{ $key }}" {{ ( $question_option->is_correct == '1') ? 'checked' : '' }}>
            <input type="text" name="option[{{$question_option->id}}]" class="form-control" placeholder="add option" required value="{{old('option')?old('option'):$question_option->option}}">
                {{-- <button class="btn btn-primary btn-add" type="add" style="margin-left: 12px;"><i class="fa fa-plus" aria-hidden="true"></i></button> --}}
                <br>
                <br>
              @endforeach
              
            </div>
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary" type="add" style="margin-top: 15px;">Update question</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  $( document ).ready(function() {
    tinymce.init({selector:'textarea'});



    // $('.options').on('click','.btn-add', function(e){
    //   e.preventDefault();

    //   var option_html = '<div class="form-group col-md-11" id="mcq"> <br> <input type="radio" name="selected-option" value="'+ ($('input[type="radio"]').length + 1)  +'"> <input type="text" name="option[]" class="form-control" placeholder="add option"> <button class="btn btn-primary btn-add" type="add" style="margin-left: 12px;"><i class="fa fa-plus" aria-hidden="true"></i></button> </div>';

    //   var delete_option = '<button class="btn btn-danger btn-remove" type="add" style="margin-left: 12px;"><i class="fa fa-minus" aria-hidden="true"></i></button>';

    //   $('.options').append(option_html); 
    //   $('.btn-remove').remove();
    //   $('input[type="radio"][value="'+($('input[type="radio"]').length)+'"]').parent().append(delete_option);
    // });

    $('.options').on('click','.btn-remove', function(e){
      e.preventDefault();
      $(this).parent().remove();
    });

  });
</script>

@endsection