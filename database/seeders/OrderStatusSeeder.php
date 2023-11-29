<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Đơn hàng mới', 'color'=>'primary'],
            ['name'=>'Đang xử lý', 'color'=>'warning'],
            ['name'=>'Hoàn thành', 'color'=>'success'],
            ['name'=>'Đã hủy', 'color'=>'danger'],
        ];
        DB::table('order_statuses')->insert($data);
    }
}
