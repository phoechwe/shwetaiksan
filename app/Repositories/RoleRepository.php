<?php

namespace   App\Repositories;

use App\Models\Role;
use App\Utils\BaseCrudRepository;


class RoleRepository extends BaseCrudRepository
{
   protected string $modelClassName = Role::class;

    protected array $creationRules = [
        'title' => 'required|string|max:255'
    ];

    protected array $updateRules = [
        'title' => 'required|string|max:255'
    ];
}
