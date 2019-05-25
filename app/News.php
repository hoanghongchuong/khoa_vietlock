<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

	protected $table='news';

	protected $fillable = ['id','name','alias','photo','background','mota','content','cate_id','status','noibat','com','title','keyword','description'];
	public function images(){
		return $this->hasMany('App\Images','news_id');
	}

	public $timestamps = true;

}
