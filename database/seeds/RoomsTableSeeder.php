<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 0; $i < 5; $i++) {
        Room::create([
          'name' => 'A.1.' . $i
        ]);
      }
    }
}
