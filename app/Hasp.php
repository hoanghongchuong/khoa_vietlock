<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasp extends Model {

	protected $table='hasp';

	protected $fillable = ['id','name','photo','id_photo','status'];

	public $timestamps = false;

	public function images(){
		return $this->hasMany('App\Images');
	}
}
