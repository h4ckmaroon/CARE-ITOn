<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestHeader extends Model
{
    protected $table = 'request_header';
    protected $fillable = [
    	'userId',
        'location',
        'qrCode',
        'isActive',
        'isCollected'
    ];

    public function user(){
    	return $this->belongsTo('App\User', 'userId');
    }

    public function detail(){
        return $this->hasMany('App\RequestDetail', 'requestId');
    }
}
