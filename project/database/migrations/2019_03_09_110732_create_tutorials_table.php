<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if (Schema::hasTable('tutorials')) return;
        Schema::create('tutorials', function (Blueprint $table) {

            $table->integer('path_id');
            $table->string('name');
            $table->string('url');
            $table->string('tacher_name');
            $table->integer('count_video');
            
            $table->primary("path_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutorials');
    }
}
