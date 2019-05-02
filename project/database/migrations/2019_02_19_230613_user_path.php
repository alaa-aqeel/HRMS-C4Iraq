<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_path')) return;
        Schema::create('user_path', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('username',45);
            $table->integer('id_path');
            $table->string('complatet',45);

            $table->unique(["username"], 'username_users_paths_UNIQUE');
            $table->primary("username");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_path');
    }
}
