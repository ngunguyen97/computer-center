<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTestScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_test_scores', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('classroom_id')->unsigned()->nullable();
          $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('set null');
          $table->integer('student_id')->unsigned()->nullable();
          $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('set null');
          $table->text('content');
          $table->boolean('status')->default(0);
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
        Schema::dropIfExists('review_test_scores');
    }
}
