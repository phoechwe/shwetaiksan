<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RoleServices
{
    protected RoleRepository $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function createRole($data)
    {
        // $validator = Validator::make($data, [
        //     'title' => 'required|string|max:255',
        // ]);

        // if ($validator->fails()) {
        //     throw new ValidationException($validator);
        // }
        return $this->roleRepository->createData($data);
    }

    public function getRoleById($id)
    {
        return $this->roleRepository->getById($id, ["permissions"]);
    }

    public function updateRole($id, $data)
    {
        // $validator = Validator::make($data, [
        //     'title' => 'required|string|max:255',
        // ]);

        // if ($validator->fails()) {
        //     throw new ValidationException($validator);
        // }
        // $permission = Role::with('permissions')->findOrFail($id);
        // $permission->update($validator->validated());
        $updateRole = $this->roleRepository->updateData($id, $data, ["permissions"]);
        return $updateRole;
    }

    public function deleteRole($id)
    {
        // $permission = Role::with('permissions')->findOrFail($id);
        return $this->roleRepository->deleteData($id);
    }
    public function getPaginatedRole($perPage = 5, $search = "")
    {

        // $query = Role::query();
        // // dd($query);
        // if ($search) {
        //     $query->where('title', 'like', "%{$search}%");
        // }

        $query = [
            "search" => $search,
            "search_columns" => ["title"]
        ];

        return $this->roleRepository->paginateData($perPage, $query);
    }
}
