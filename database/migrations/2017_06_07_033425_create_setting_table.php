<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('setting', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->text('title');
			$table->text('company');
			$table->text('address');
			$table->text('phone');
			$table->text('didong');
			$table->text('fax');
			$table->text('email');
			$table->text('photo')->nullable();
			$table->longText('desc')->nullable();
			$table->longText('content')->nullable();
			$table->integer('status');
			$table->longText('codechat')->nullable();
			$table->longText('analytics')->nullable();
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
		Schema::dropIfExists('setting');
	}

}
