<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model {

	protected $table = 'images';
	protected $fillable = ['name','image_path','alt','photo','product_id','status','stt'];
	// public $timestamps = false;
	public function product(){
		return $this->belongsTo('App\Products');
	}

}
