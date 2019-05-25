<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('title');
			$table->text('photo')->nullable();
			$table->longText('codemap')->nullable();
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->integer('status');
			$table->longText('keyword')->nullable();
			$table->longText('description')->nullable();
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
		Schema::dropIfExists('contact');
	}

}
