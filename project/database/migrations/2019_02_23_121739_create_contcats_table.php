<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('contcats')) return;
        Schema::create('contcats', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('username',30);
            $table->string('id_facebook', 25)->unique()->nullable();
            $table->string('id_github',   25)->unique()->nullable();
            $table->string('id_telegram', 25)->unique();
            $table->string('telephone',   25)->unique()->nullable();
            $table->string('other_email', 45)->unique()->nullable();

            $table->timestamps();

            $table->unique(["username"], 'username_UNIQUE');
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
        Schema::dropIfExists('contcats');
    }
}
