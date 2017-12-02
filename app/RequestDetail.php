<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
    protected $table = 'request_detail';
    public $incrementing = false;
    protected $fillable = [
        'requestId',
    	'itemId',
        'photo',
        'description'
    ];

    public function header(){
    	return $this->belongsTo('App\RequestHeader', 'requestId');
    }
}
