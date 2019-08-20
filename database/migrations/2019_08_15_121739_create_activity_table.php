<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->date('date');
          $table->text('descriptions');
          $table->string('speaker_name');
          $table->tinyInteger('type');
          $table->timestamps();
          $table->softDeletes();
      });
      DB::statement("ALTER TABLE activity ADD image MEDIUMBLOB null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
