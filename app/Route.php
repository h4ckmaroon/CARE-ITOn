<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'route';
    protected $fillable = [
    	'requestId',
    	'collectorId',
        'dateTime',
        'isActive'
    ];

    public function request(){
    	return $this->belongsTo('App\RequestHeader', 'requestId');
    }
   
    public function collector(){
    	return $this->belongsTo('App\User', 'collectorId');
    }
}
