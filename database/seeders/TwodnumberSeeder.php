<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TwodnumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 99; $i++) {
            DB::table('twodnumbers')->insert([
                'number' => str_pad($i, 2, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
