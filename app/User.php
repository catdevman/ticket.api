<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Moloquent implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $primaryKey = '_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'gender'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
