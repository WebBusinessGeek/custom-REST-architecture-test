<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auths', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userId');
			$table->char('ipAddress');
			$table->char('publicToken');
			$table->dateTime('expiresOn');
			$table->char('hashSecret');
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
		Schema::drop('auths');
	}

}
