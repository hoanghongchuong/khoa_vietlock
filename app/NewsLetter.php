<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model {

	protected $table='newsletter';

	protected $fillable = ['id','name','link','email','phone','photo','mota','content','status','noibat','com'];

	public $timestamps = true;

}
