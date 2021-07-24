<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [];

    public function Questions()
    {
        return $this->hasMany('App\question','test_id','id');
    }

    public function Test()
    {
        return $this->hasOne('App\test','id','test_id');
    }


}
