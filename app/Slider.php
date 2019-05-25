<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

	protected $table='slider';

	protected $fillable = ['id','name','link','photo','mota','content','status','noibat','com'];

	public $timestamps = true;

}
