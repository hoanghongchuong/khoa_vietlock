<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider', function(Blueprint $table)
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
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('slider');
	}

}
