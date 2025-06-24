<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        //
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'customer_create',
            ],
            [
                'id'    => 18,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 19,
                'title' => 'customer_show',
            ],
            [
                'id'    => 20,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 21,
                'title' => 'customer_access',
            ],
            [
                'id'    => 22,
                'title' => 'total_balance_create',
            ],
            [
                'id'    => 23,
                'title' => 'total_balance_edit',
            ],
            [
                'id'    => 24,
                'title' => 'total_balance_show',
            ],
            [
                'id'    => 25,
                'title' => 'total_balance_delete',
            ],
            [
                'id'    => 26,
                'title' => 'total_balance_access',
            ],
            [
                'id'    => 27,
                'title' => 'bank_account_create',
            ],
            [
                'id'    => 28,
                'title' => 'bank_account_edit',
            ],
            [
                'id'    => 29,
                'title' => 'bank_account_show',
            ],
            [
                'id'    => 30,
                'title' => 'bank_account_delete',
            ],
            [
                'id'    => 31,
                'title' => 'bank_account_access',
            ],
            [
                'id'    => 32,
                'title' => 'deposit_request_create',
            ],
            [
                'id'    => 33,
                'title' => 'deposit_request_edit',
            ],
            [
                'id'    => 34,
                'title' => 'deposit_request_show',
            ],
            [
                'id'    => 35,
                'title' => 'deposit_request_delete',
            ],
            [
                'id'    => 36,
                'title' => 'deposit_request_access',
            ],
            [
                'id'    => 37,
                'title' => 'withdrawl_create',
            ],
            [
                'id'    => 38,
                'title' => 'withdrawl_edit',
            ],
            [
                'id'    => 39,
                'title' => 'withdrawl_show',
            ],
            [
                'id'    => 40,
                'title' => 'withdrawl_delete',
            ],
            [
                'id'    => 41,
                'title' => 'withdrawl_access',
            ],
            [
                'id'    => 42,
                'title' => 'payment_record_create',
            ],
            [
                'id'    => 43,
                'title' => 'payment_record_edit',
            ],
            [
                'id'    => 44,
                'title' => 'payment_record_show',
            ],
            [
                'id'    => 45,
                'title' => 'payment_record_delete',
            ],
            [
                'id'    => 46,
                'title' => 'payment_record_access',
            ],
            [
                'id'    => 47,
                'title' => 'two_d_ledger_create',
            ],
            [
                'id'    => 48,
                'title' => 'two_d_ledger_edit',
            ],
            [
                'id'    => 49,
                'title' => 'two_d_ledger_show',
            ],
            [
                'id'    => 50,
                'title' => 'two_d_ledger_delete',
            ],
            [
                'id'    => 51,
                'title' => 'two_d_ledger_access',
            ],
            [
                'id'    => 52,
                'title' => 'twod_threed_record_create',
            ],
            [
                'id'    => 53,
                'title' => 'twod_threed_record_edit',
            ],
            [
                'id'    => 54,
                'title' => 'twod_threed_record_show',
            ],
            [
                'id'    => 55,
                'title' => 'twod_threed_record_delete',
            ],
            [
                'id'    => 56,
                'title' => 'twod_threed_record_access',
            ],
            [
                'id'    => 57,
                'title' => 'threed_ledger_create',
            ],
            [
                'id'    => 58,
                'title' => 'threed_ledger_edit',
            ],
            [
                'id'    => 59,
                'title' => 'threed_ledger_show',
            ],
            [
                'id'    => 60,
                'title' => 'threed_ledger_delete',
            ],
            [
                'id'    => 61,
                'title' => 'threed_ledger_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
