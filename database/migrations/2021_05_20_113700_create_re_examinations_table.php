<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('re_examinations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('classroom_id')->unsigned()->nullable();
          $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('set null');
          $table->integer('order_id')->unsigned()->nullable();
          $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('set null');
          $table->integer('student_id')->unsigned()->nullable();
          $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('re_examinations');
    }
}
