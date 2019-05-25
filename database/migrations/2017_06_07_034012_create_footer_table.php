<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('footer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('title');
			$table->text('photo')->nullable();
			$table->longText('codemap')->nullable();
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->integer('status');
			$table->integer('stt');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('footer');
	}

}
