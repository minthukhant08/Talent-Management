<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('descriptions');
            $table->date('date');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('topic_id');
            $table->timestamps();
            $table->foreign('teacher_id')
                  ->references('id')->on('user')
                  ->onDelete('cascade');
            $table->foreign('topic_id')
                  ->references('id')->on('topic')
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
        Schema::dropIfExists('topic_detail');
    }
}
