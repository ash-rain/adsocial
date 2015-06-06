<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradingTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('market', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('provider', 10)->index();
			$table->string('action', 8)->index();
			$table->integer('reward')->unsigned();
			$table->bigInteger('post_id')->unsigned()->index();
			$table->bigInteger('user_id')->index();
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
		Schema::drop('market');
	}

}
