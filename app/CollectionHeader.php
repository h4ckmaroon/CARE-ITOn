<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionHeader extends Model
{
    protected $table = 'collection_header';
    protected $fillable = [
        'requestId',
        'collectorId'
    ];

    public function route(){
    	return $this->belongsTo('App\Route', 'routeId');
    }

    public function request(){
        return $this->belongsTo('App\RequestHeader', 'requestId');
    }
    
    public function detail(){
    	return $this->hasMany('App\CollectionDetail', 'collectionId');
    }

    public function collector(){
    	return $this->hasMany('App\User', 'collectorId');
    }
}
