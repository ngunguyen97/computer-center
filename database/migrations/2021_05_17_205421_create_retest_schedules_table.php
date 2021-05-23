<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetestSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retest_schedules', function (Blueprint $table) {
          $table->increments('id');
          $table->string('schedule_type')->nullable();
          $table->integer('classroom_id')->unsigned()->nullable();
          $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('set null');
          $table->integer('teacher_id')->unsigned()->nullable();
          $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('set null');
          $table->integer('room_id')->unsigned()->nullable();
          $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('set null');
          $table->date('start_registration_day')->nullable();
          $table->date('end_registration_day')->nullable();
          $table->time('start_time')->nullable();
          $table->time('end_time')->nullable();
          $table->date('start_day')->nullable();
          $table->date('end_day')->nullable();
          $table->string('weekdays')->nullable();
          $table->string('color')->nullable();
          $table->text('reexamination_fee')->nullable();
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
        Schema::dropIfExists('retest_schedules');
    }
}
