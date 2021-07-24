<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [];

    public function CreatedBy()
    {
        return $this->hasOne('App\user','id','created_by');
    }

    public function UpdatedBy()
    {
        return $this->hasOne('App\user','id','updated_by');
    }

    public function QuestionOptions()
    {
        return $this->hasMany('App\Question_Option','question_id','id');
    }
}
