<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortenerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_links', function (Blueprint $table) {
      			$table->bigIncrements('id');
      			$table->string('hash', 16)->unique()->index();
      			$table->string('url');
      			$table->integer('visits')->default(0);
      			$table->bigInteger('user_id');
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
        Schema::drop('short_links');
    }
}
