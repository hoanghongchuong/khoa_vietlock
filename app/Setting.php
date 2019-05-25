<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

	protected $table='setting';

	protected $fillable = ['id','name','title','photo','company','address','phone','hotline','fax','email','photo','mota','content','status','codechat','analytics','keyword','description'];

	public $timestamps = true;
}
