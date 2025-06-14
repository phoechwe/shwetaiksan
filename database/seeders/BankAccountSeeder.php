<?php

namespace Database\Seeders;

use App\Models\AdminBankAccount;
use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    public function run()
    {
        $bank = [
            [
                'id'    => 1,
                'bank_type' => 'KBZ Pay',
            ],
            [
                'id'    => 2,
                'bank_type' => 'AYA Pay',
            ],
            [
                'id'    => 3,
                'bank_type' => 'Wave Money',
            ],
        ];

        BankAccount::insert($bank);
    }
}
