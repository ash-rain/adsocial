<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('provider', 8)->index();
			$table->string('provider_id')->index()->unique();
			$table->string('text');
			$table->string('image')->nullable();
			$table->string('link')->nullable();
			$table->bigInteger('user_id')->unsigned()->index();
			$table->timestamp('posted_at');
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
		Schema::drop('posts');
	}

}
