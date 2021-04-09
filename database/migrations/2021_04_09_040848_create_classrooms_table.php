<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('classrooms', function (Blueprint $table) {
      $table->increments('id');
      $table->string('HP_id')->unique();
      $table->string('slug')->unique();
      $table->string('name');
      $table->string('schedule');
      $table->integer('fee');
      $table->date('start_day');
      $table->integer('quantity');
      $table->boolean('status')->default(1);

//      $table->integer('room_id')->unsigned()->nullable();
//      $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('set null');

      $table->integer('teacher_id')->unsigned()->nullable();
      $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('set null');

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
    Schema::dropIfExists('classrooms');
  }
}
