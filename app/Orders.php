<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = "orders";
    public $timestamps = true;

    public function orders_detail(){
    	return $this->hasMany('App\OrderDetail','id_order','id');
    }

    public function orders(){
    	return $this->belongsTo('App\Users','id_user','id');
    }
}
