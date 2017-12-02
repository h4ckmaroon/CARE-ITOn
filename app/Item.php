<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $fillable = [
        'categoryId',
        'name',
        'description',
        'rate',
        'isActive'
    ];

    public function category(){
    	return $this->belongsTo('App\ItemCategory', 'categoryId');
    }
}
