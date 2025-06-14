<?php

namespace   App\Repositories;

use App\Models\User;
use App\Utils\BaseCrudRepository;


class UserRepository extends BaseCrudRepository
{
   protected string $modelClassName = User::class;
   protected array $creationRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'roles' => 'required'
    ];

    protected array $updateRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,id',
        'password' => 'nullable',
        'roles' => 'required'
    ];

    // public  function getCustomerAccount()
}
