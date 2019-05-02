<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user_projects')) return;
        Schema::create('user_projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments("id");
            $table->string('username',45);
            $table->string('project_name',45);
            $table->date("start_at");
            $table->date('end_at');
            $table->text('about_project');
            $table->string('github_url',45);
            $table->string('tags',250);

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
        Schema::dropIfExists('user_projects');
    }
}
