<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('rooms', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('MaHP')->unique();
      $table->string('slug')->unique();
      $table->string('TenLH');
      $table->string('LichHoc');
      $table->integer('HocPhi');
      $table->date('NgayBD');
      $table->boolean('TrangThai')->default(1);
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
    Schema::dropIfExists('classes');
  }
}
