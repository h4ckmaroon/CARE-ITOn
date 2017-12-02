<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRate extends Model
{
    protected $table = 'item_rate';
    public $incrementing = false;
    protected $fillable = [
    	'itemId',
        'rate'
    ];

    public function item(){
    	return $this->belongsTo('App\Item', 'itemId');
    }
}
