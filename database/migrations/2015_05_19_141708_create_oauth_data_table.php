<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth_data', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('provider', 10)->index();
			$table->string('provider_id')->index();
			$table->string('token');
			$table->json('user_data')->nullable();
			$table->bigInteger('user_id')->unsigned();
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
		Schema::drop('oauth_data');
	}

}
