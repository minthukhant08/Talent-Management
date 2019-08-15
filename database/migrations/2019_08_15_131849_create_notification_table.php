<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type');
            $table->string('title');
            $table->string('descrptions');
            $table->date('date');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')->on('user')
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
        Schema::dropIfExists('notification');
    }
}
