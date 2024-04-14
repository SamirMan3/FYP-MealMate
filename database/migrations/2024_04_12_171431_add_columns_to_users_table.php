<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('qualification')->nullable();
            $table->text('experience')->nullable();
            $table->text('about')->nullable();
            $table->integer('count')->nullable();
            $table->tinyInteger('is_new')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('qualification');
            $table->dropColumn('experience');
            $table->dropColumn('about');
            $table->dropColumn('count');
            $table->dropColumn('is_new');
        });
    }
}
