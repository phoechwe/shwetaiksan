<?php

namespace   App\Repositories;

use App\Models\Permission;
use App\Utils\BaseCrudRepository;


class PermissionRepository extends BaseCrudRepository
{
   protected string $modelClassName = Permission::class;

    protected array $creationRules = [
        'title' => 'required|string|max:255'
    ];

    protected array $updateRules = [
        'title' => 'required|string|max:255'
    ];

}
