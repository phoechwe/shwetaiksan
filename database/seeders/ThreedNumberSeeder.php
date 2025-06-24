<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreedNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 000; $i <= 999; $i++) {
            DB::table('threed_numbers')->insert([
                'number' => str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
