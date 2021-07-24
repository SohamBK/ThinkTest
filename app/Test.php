<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Test extends Model
{
    //laravel slug
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'test_name'
            ]
        ];
    }

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;

    public static $status=[
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive'
    ];

    protected $fillable = [];

    public function scopeSearch($query, $column = 'test_name', $keyword, $status)
    {
        return $query->where($column?$column:'test_name' , 'like' , '%'.$keyword.'%');
    }

    public function CreatedBy()
    {
        return $this->hasOne('App\user','id','created_by');
    }

    public function UpdatedBy()
    {
        return $this->hasOne('App\user','id','updated_by');
    }
    
    public function Questions()
    {
        return $this->hasMany('App\question','test_id','id');
    }

    
}
