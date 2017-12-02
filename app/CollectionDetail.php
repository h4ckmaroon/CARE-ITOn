<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionDetail extends Model
{
    protected $table = 'collection_detail';
    public $incrementing = false;
    protected $fillable = [
    	'collectionId',
    	'itemId',
        'quantity'
    ];

    public function header(){
    	return $this->belongsTo('App\CollectionHeader', 'collectionId');
    }
    
    public function item(){
    	return $this->belongsTo('App\Item', 'itemId');
    }
}
