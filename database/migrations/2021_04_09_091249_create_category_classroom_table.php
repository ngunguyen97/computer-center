<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryClassroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_classroom', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('classroom_id')->unsigned()->nullable();
          $table->foreign('classroom_id')->references('id')
            ->on('classrooms')->onDelete('cascade');

          $table->integer('category_id')->unsigned()->nullable();
          $table->foreign('category_id')->references('id')
            ->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('category_classroom');
    }
}
