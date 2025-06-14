<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    $users = [
      [

        'name'           => 'Admin',
        'email'          => 'admin@admin.com',
        'password'       => bcrypt('password'),
        'remember_token' => null,
        'created_at'     => '2021-09-01 00:00:00',
        'updated_at'     => '2021-09-02 00:00:00',
      ],
      [

        'name'           => 'Sub Admin',
        'email'          => 'admin@gmail.com',
        'password'       => bcrypt('password'),
        'remember_token' => null,
        'created_at'     => '2021-09-07 00:00:00',
        'updated_at'     => '2021-09-09 00:00:00',
      ],
    ];

    User::insert($users);
  }
}
