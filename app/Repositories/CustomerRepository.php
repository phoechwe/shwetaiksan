<?php

namespace   App\Repositories;

use App\Models\User;
use App\Utils\BaseCrudRepository;


class CustomerRepository extends BaseCrudRepository
{
   protected string $modelClassName = User::class;
    protected array $creationRules = [
        'name' => 'required|string|max:255',
        'phone_no' => 'required',
        'password' => 'required',
    ];

    protected array $updateRules = [
        'name' => 'required|string|max:255',
        'phone_no' => 'required',
        'password' => 'nullable',
    ];
}
