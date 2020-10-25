<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_progresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->text('description');
            $table->integer('agreement');
            $table->timestamps();

            $table->unsignedBigInteger('group_project_supervisor_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('group_project_supervisor_id')->references('id')->on('group_projects_supervisors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_progresses');
    }
}
