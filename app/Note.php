<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Note extends Moloquent
{

    protected $connection = 'mongodb';
    protected $primaryKey = '_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'workTime',
        'driveTime',
        'billable',
        'mileage',
        'private',
        'resolving'
    ];

    public function creator(){
      return $this->hasOne(\App\User::class);
    }
}
