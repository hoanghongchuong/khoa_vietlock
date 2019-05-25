<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	protected $table='menu';

	protected $fillable = ['id','name','alias','parent_id','stt','status','title','keyword','description'];

	public $timestamps = true;

}
