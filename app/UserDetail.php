<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail';
    public $incrementing = false;
    protected $fillable = [
    	'userId',
        'firstName',
        'middleName',
        'lastName',
        'contactNo',
        'email'
    ];

    public function user(){
    	return $this->belongsTo('App\User', 'userId');
    }
}
