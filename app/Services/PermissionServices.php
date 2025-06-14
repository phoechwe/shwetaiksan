<?php

namespace App\Services;


use App\Repositories\PermissionRepository;

class PermissionServices
{
    private PermissionRepository $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function createPermission($data)
    {
        // $validator = $this->validtateData($data, [
        //     'title' => 'required|string|max:255'
        // ]);

        // return Permission::create($validator);
        $permission = $this->permissionRepository->createData($data);

        return $permission;
    }

    public function getPermissionById($id)
    {
        return $this->permissionRepository->getById($id);
    }

    public function updatePermission($id, $data)
    {
        $permission = $this->permissionRepository->updateData($id, $data);
        return $permission;
    }

    public function deletePermission($id)
    {
        return $this->permissionRepository->deleteData($id);
    }

    public function getPaginatedPermissions($perPage = 40, $search = "")
    {
        // return Permission::paginate($perPage);
        // $query = Permission::query();
        // if ($search) {
        //     $query->where('title', 'like', "%{$search}%");
        // }
        $query = [
            "search" => $search,
            "search_columns" => ["title"]
        ];

        return $this->permissionRepository->paginateData($perPage, $query);
    }
}
