<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	protected $table='products';

	protected $fillable = ['id','name','alias','photo','price','price_old','cate_id','noibat','spbc','status','title','keyword','description','tinhtrang','namsanxuat','thuonghieu','baohanh','model','quatang','huongdan','vanchuyen'];

	public $timestamps = true;

	public function pimg(){
		return $this->hasMany('App\Images','product_id');
	}
	
}
