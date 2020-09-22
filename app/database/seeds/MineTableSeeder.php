<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->truncate();
        DB::table('mine')->insert([
            'name' => 'suguki',
            'age' => '26',
        ]);
    }
}
