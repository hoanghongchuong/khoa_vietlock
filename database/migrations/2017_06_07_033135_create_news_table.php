<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cate_id')->unsigned();
			$table->string('name');
			$table->string('alias');
			$table->text('photo')->nullable();
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->integer('status');
			$table->longText('keyword')->nullable();
			$table->longText('description')->nullable();
			$table->text('com');
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
		Schema::dropIfExists('news');
	}

}
