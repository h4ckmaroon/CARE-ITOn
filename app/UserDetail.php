<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_detail';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
    	'userId',
        'firstName',
        'middleName',
        'lastName',
        'contactNo',
        'email',
        'photo'
    ];

    public function user(){
    	return $this->belongsTo('App\User', 'userId');
    }
}
