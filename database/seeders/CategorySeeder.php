<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Xe số'],
            ['name'=>'Xe tay ga'],
            ['name'=>'Xe côn tay'],
            ['name'=>'Xe 50cc'],
        ];
        DB::table('categories')->insert($data);
    }
}
