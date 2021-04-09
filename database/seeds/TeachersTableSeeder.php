<?php

use Illuminate\Database\Seeder;
use App\Teacher;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
          'name' => 'Kiều Trung Tiến',
          'date' => '1987-11-03',
          'address' => '294 - 296 Trường Sa, Phường 2, Quận Phú Nhuận',
          'degree' => 'Tiến sĩ'
        ]);
    }
}
