<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
    protected $table = 'request_detail';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'requestId',
    	'itemId',
        'photo',
        'description'
    ];

    public function header(){
    	return $this->belongsTo('App\RequestHeader', 'requestId');
    }
    
    public function item(){
    	return $this->belongsTo('App\Item', 'itemId');
    }
}
