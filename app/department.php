<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    public static $status=[
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive'
    ];

    protected $fillable = [];

    public function scopeSearch($query, $column = 'department_name', $keyword, $status)
    {
        return $query->where($column?$column:'department_name' , 'like' , '%'.$keyword.'%');
    }
    

    public function CreatedBy()
    {
        return $this->hasOne('App\user','id','created_by');
    }

    public function UpdatedBy()
    {
        return $this->hasOne('App\user','id','updated_by');
    }
}


