<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('order_detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_user');
			$table->integer('id_order');
			$table->integer('id_product');
			$table->text('photo');
			$table->text('name');
			$table->text('hoten');
			$table->integer('price');
			$table->text('qty');
			$table->integer('totalprice');
			$table->integer('tonggia');
			$table->longText('donhang');
			$table->integer('status');
			$table->integer('stt');
			$table->timestamps(); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('order_detail');
	}

}
