<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('info_users')) return;
        Schema::create('info_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->string('username',30);
            $table->string('gender', 15);
            $table->date('bron');
            $table->text('about');
            $table->string('skills', 45)->nullable();
            $table->string('image_profile', 45)->nullable();
            $table->string('educational_attainment', 45)->nullable();
            // $table->string('programming_languages', 45)->nullable();
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
        Schema::dropIfExists('info_users');
    }
}
