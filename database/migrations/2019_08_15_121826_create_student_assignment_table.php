<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_assignment', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('student_id');
          $table->unsignedBigInteger('assignment_id');
          $table->tinyInteger('marks');
          $table->timestamps();
          $table->foreign('student_id')
                ->references('id')->on('user')
                ->onDelete('cascade');
          $table->foreign('assignment_id')
                ->references('id')->on('assignment')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_assignment');
    }
}
