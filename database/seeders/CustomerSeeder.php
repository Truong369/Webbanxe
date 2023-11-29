<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'fullName'=>'Lê Sơn Nam',
            'address'=>'Đồng Tháp',
            'email'=>'lnam6507@gmail.com',
            'password'=>Hash::make('sonnam'),
            'phone'=>'0354632349',
            'gender'=>0,
            'created_at'=>'2022-10-04 00:00:00',
        ]);
    }
}
