<?php

use Illuminate\Database\Seeder;
use App\Classroom;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $room = Classroom::create([
        'HP_id' => 'HP_CNTT',
        'slug' => 'luyen-thi-chung-chi-ung-dung-cntt-co-ban',
        'name' => 'Luyện Thi Chứng chỉ Ứng Dụng CNTT Cơ bản',
        'schedule' => 'Thứ 3-5 (13:30 - 17:00) - Ngày thi dự kiến 15/04/2021',
        'fee' => 1500000,
        'start_day' => '2020-04-05',
        'quantity' => 40,
        'teacher_id' => 1
      ]);
      $room->rooms()->attach(1);
    }
}
