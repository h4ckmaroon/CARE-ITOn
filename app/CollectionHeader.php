<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionHeader extends Model
{
    protected $table = 'collection_header';
    protected $fillable = [
    	'requestId'
    ];

    public function route(){
    	return $this->belongsTo('App\Route', 'routeId');
    }
    
    public function detail(){
    	return $this->hasMany('App\CollectionDetail', 'collectionId');
    }
}
