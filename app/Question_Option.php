<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_Option extends Model
{
    public $table = 'question_option';

    protected $fillable = [];

    public function CreatedBy()
    {
        return $this->hasOne('App\user','id','created_by');
    }

    public function UpdatedBy()
    {
        return $this->hasOne('App\user','id','updated_by');
    }
}
