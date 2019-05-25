<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model {

	protected $table='about';

	protected $fillable = ['id','name','alias','photo','mota','com','status','title','keyword','description'];

	public $timestamps = true;

}
