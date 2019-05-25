<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('photo')->nullable();
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->string('com');
			$table->integer('status');
			$table->integer('stt');
		});
		// Schema::create('orders', function(Blueprint $table)
		// {
		// 	$table->increments('id');
		// 	$table->integer('id_user');
		// 	$table->text('madonhang');
		// 	$table->text('hoten');
		// 	$table->text('dienthoai');
		// 	$table->text('email');
		// 	$table->text('diachi')
		// 	$table->text('tonggia');
		// 	$table->longText('donhang');
		// 	$table->integer('status');
		// 	$table->integer('stt');
		// 	$table->timestamps();
		// });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('orders');
	}

}
