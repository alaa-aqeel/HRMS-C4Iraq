<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Members extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('members')) return;
        Schema::create('members', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('username',30);
            $table->string('email', 30)->unique();
            $table->string('governorate', 45);
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('password', 60);

            $table->integer('id_path_manger')->default(0);
            $table->boolean('team_manger')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamps();

            $table->unique(["id"], 'user_id_UNIQUE');
            $table->unique(["username"], 'username_UNIQUE');

            $table->dropPrimary("id");
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
        Schema::dropIfExists('members');
    }
}
