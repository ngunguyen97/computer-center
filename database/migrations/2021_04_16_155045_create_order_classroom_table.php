<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderClassroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_classroom', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('order_id')->unsigned()->nullable();
          $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('set null');

          $table->integer('classroom_id')->unsigned()->nullable();
          $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('order_classroom');
    }
}
