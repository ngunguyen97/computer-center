<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i = 1; $i < 5; $i++) {
      Room::create([
        'MaHP' => 'LHP_' . $i,
        'slug' => 'LHP-' . $i,
        'TenLH' => 'Luyện Thi Chứng chỉ Ứng Dụng CNTT Cơ bản ' . $i,
        'LichHoc' => 'Thứ 3-5 (13:30 - 17:00) - Ngày thi dự kiến 15/04/2021',
        'HocPhi' => rand(149999, 249999),
        'NgayBD' => date("m-d-y")
      ]);
    }
  }
}
