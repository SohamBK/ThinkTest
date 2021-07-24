<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [];

    public function QuestionOptions()
    {
        return $this->hasMany('App\Question_Option','question_id','id');
    }
}
