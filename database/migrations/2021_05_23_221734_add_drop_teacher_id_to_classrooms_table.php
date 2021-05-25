<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDropTeacherIdToClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('classrooms', 'teacher_id')) {
          Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign('classrooms_teacher_id_foreign');
            $table->dropColumn('teacher_id');
          });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
