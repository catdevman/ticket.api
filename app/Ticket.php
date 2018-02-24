<?php

namespace App;

use \App\Note;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Ticket extends Moloquent
{
    const STATUES = array(
      'PENDING' => 1,
      'OPEN' => 2,
      'ON_HOLD' => 3,
      'CLOSED' => 4
    );

    const PRIORITIES = array(
      'LOW' => 1,
      'MEDIUM' => 2,
      'HIGH' => 3,
      'ASAP' => 4
    );

    protected $connection = 'mongodb';
    protected $collection = 'tickets';
    protected $primaryKey = '_id';
    protected $dates = array('created_at','updated_at','startDate', 'endDate', 'dueDate', 'closedDate');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'department',
        'category',
        'status',
        'priority',
        'client',
        'room',
        'asset',
        'startDate',
        'endDate',
        'dueDate',
        'closedDate',
        'notes'
    ];

    public function creator(){
      return $this->hasOne(\App\User::class);
    }

    public function owners(){
      return $this->belongsToMany(\App\User::class);
    }

    public function notes(){
      return $this->embedsMany(Note::class);
    }
}
