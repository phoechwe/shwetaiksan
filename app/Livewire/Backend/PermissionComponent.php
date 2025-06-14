<?php

namespace App\Livewire\Backend;

use App\Services\PermissionServices;
use App\Traits\HandleRedirections;
use App\Traits\HandlePageState;
use App\Traits\HandleFlashMessage;
use App\Traits\AuthorizeRequests;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PermissionComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]

    public $currentPage = 'list', $title, $permission_id;
    public $search = '';

    protected $permissionService;

    protected $indexRoute = "admin/permission";
    protected $createRoute, $editRoute, $showRoute;

    public function boot(PermissionServices $permissionService)
    {
        $this->permissionService = $permissionService;
        $this->authorizeAccess('permission_access');
    }
    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("permission_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }

    public function create()
    {
        $this->verifyAuthorization("permission_create");
        $this->resetPage();
        $this->currentPage = "create";
    }

    public function store()
    {
        $this->verifyAuthorization("permission_create");
        $this->permissionService->createPermission([
            'title' => $this->title,
        ]);

        $this->flashMessage('Permission created successfully!', 'success');
        return $this->redirectTo($this->indexRoute);
    }

    public function edit($id)
    {
        $this->verifyAuthorization('permission_edit');
        $permission = $this->permissionService->getPermissionById($id);
        $this->title = $permission->title;
        $this->permission_id = $permission->id;
        $this->currentPage = "edit";
    }

    public function update()
    {
        $this->verifyAuthorization("permission_edit");
        $this->permissionService->updatePermission($this->permission_id, [
            'title' => $this->title,
        ]);

        $this->flashMessage('Permission updated successfully!', 'success');
        session()->flash('type', 'success');

        return $this->redirectTo($this->indexRoute);
    }

    public function show($id)
    {
        $this->verifyAuthorization('permission_edit');
        $permission = $this->permissionService->getPermissionById($id);
        $this->title = $permission->title;
        $this->permission_id = $permission->id;
        $this->currentPage = "show";
    }

    public function delete($id)
    {
        $this->verifyAuthorization("permission_delete");
        $this->permissionService->deletePermission($id);

        $this->flashMessage('Permission updated successfully!', 'success');

        return $this->redirectTo($this->indexRoute);
    }

    public function render()
    {
        switch ($this->currentPage) {
            case 'create':
                return view('backend.admin.permission.create');
            case 'edit':
                return view('backend.admin.permission.edit');
            case 'show':
                return view('backend.admin.permission.show');
            default:
                return view('backend.admin.permission.index', [
                    'permissions' => $this->permissionService->getPaginatedPermissions(5, $this->search),
                ]);
        }
    }
}
