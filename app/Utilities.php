<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
    protected $table = 'utilities';
    protected $fillable = [
    	'username',
        'password',
        'clientId',
        'clientSecret',
        'oauth'
    ];
}
