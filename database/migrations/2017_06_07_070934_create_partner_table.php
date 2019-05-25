<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partner', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('url');
			$table->text('photo')->nullable();
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->string('com');
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
		Schema::dropIfExists('partner');
	}

}
