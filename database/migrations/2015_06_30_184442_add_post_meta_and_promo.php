<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostMetaAndPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('posts', function ($table) {
        $table->json('meta')->nullable();
        $table->timestamp('promoted_until')->nullable()->index();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('posts', function ($table) {
        $table->dropColumn('meta');
        $table->dropColumn('promoted_until');
        $table->dropIndex('promoted_until');
      });
    }
}
