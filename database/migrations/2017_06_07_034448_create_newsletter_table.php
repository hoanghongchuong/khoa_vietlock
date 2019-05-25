<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('phone')->nullable();
			$table->text('email')->nullable();
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
		Schema::dropIfExists('newsletter');
	}

}
