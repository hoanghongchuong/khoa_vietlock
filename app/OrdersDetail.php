<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    protected $table = "order_detail";

    public function products(){
    	return $this->belongsTo('App\Products','id_product','id');
    }

    public function orders(){
    	return $this->belongsTo('App\Orders','id_order','id');
    }
}
