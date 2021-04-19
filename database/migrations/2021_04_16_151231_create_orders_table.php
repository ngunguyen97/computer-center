<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('set null');
            $table->string('billing_fullname');
            $table->string('billing_id_card');
            $table->string('billing_email');
            $table->string('billing_address');
            $table->string('billing_phone');
            $table->string('billing_selected_object');
            $table->string('payment_types');
            $table->string('billing_name_on_card')->nullable();
            $table->integer('billing_total')->default(0);
            $table->string('payment_gateway')->default('stripe');
            $table->boolean('status')->default(0);
            $table->string('error')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
