<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComfirmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('noti_id')->nullable();
            $table->text('code')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')->on('user')
                  ->onDelete('cascade');
            $table->foreign('noti_id')
                  ->references('id')->on('notification')
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
        Schema::dropIfExists('comfirm');
    }
}
