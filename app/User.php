<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function DepartmentName()
    {
        return $this->hasOne('App\department','id','department_id');
    }

    public function scopeSearch($query, $column = 'name', $keyword)
    {
        return $query->where($column?$column:'name' , 'like' , '%'.$keyword.'%');
    }
}
