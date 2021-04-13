<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $now = \Carbon\Carbon::now()->toDateTimeString();
      \App\Category::insert([
        ['name' => 'Tin học văn phòng', 'slug' => 'tin-hoc-van-phong', 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'Lập trình và CSDL', 'slug' => 'lap-trinh-va-csdl', 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'Đồ họa đa truyền thông', 'slug' => 'do-hoa-da-truyen-thong', 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'Kiểm thử phần mềm', 'slug' => 'kiem-thu-phan-mem', 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'Thiết kế website', 'slug' => 'thiet-ke-website', 'created_at' => $now, 'updated_at' => $now],
        ['name' => 'Lập trình di động', 'slug' => 'lap-trinh-di-dong', 'created_at' => $now, 'updated_at' => $now],

      ]);
    }
}
