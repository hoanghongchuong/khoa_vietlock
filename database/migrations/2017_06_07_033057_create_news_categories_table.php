<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('alias');
			$table->string('photo');
			$table->integer('status');
			$table->integer('lever');
			$table->integer('parent_id');
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
		Schema::dropIfExists('news_categories');
	}

}
