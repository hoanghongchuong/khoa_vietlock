<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cate_id')->unsigned();
			$table->string('name');
			$table->string('alias');
			$table->text('photo')->nullable();
			$table->integer('price');
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->integer('status');
			$table->integer('user_id')->unsigned();
			$table->longText('keyword')->nullable();
			$table->longText('description')->nullable();
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
		Schema::dropIfExists('products');
	}

}
