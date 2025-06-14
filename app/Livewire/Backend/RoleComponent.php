<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Permission;
use App\Traits\HandleRedirections;
use App\Traits\HandlePageState;
use App\Traits\HandleFlashMessage;
use App\Traits\AuthorizeRequests;
use Livewire\WithPagination;
use App\Services\RoleServices;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
class RoleComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $title, $role_id;
    protected $roleService;
    public $permissions = [];
    public $selectedPermissions = [];
    public $search = '';

    protected $indexRoute = "admin/role";
    protected $createRoute, $editRoute, $showRoute;


    public function boot(RoleServices $roleService)
    {
        $this->roleService = $roleService;
        $this->verifyAuthorization("role_access");
    }

    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("role_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }
    public function create()
    {
        $this->verifyAuthorization("role_access");
        $this->resetPage();
        $this->currentPage = 'create';
    }
    public function store()
    {
        $this->verifyAuthorization("role_create");
        $role = $this->roleService->createRole([
            'title' => $this->title,
        ]);

        $role->permissions()->sync($this->selectedPermissions);

        $this->flashMessage('Role created successfully!', 'success');
        return $this->redirectTo($this->indexRoute);
    }
    public function edit($id)
    {
        $this->verifyAuthorization("role_edit");
        $role = $this->roleService->getRoleById($id);
        $this->role_id = $role->id;
        $this->title = $role->title;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->currentPage = 'edit';
    }

    public function update()
    {
        $this->verifyAuthorization("role_edit");
        $role = $this->roleService->updateRole($this->role_id, [
            'title' => $this->title,
        ]);
        $role->permissions()->sync($this->selectedPermissions);
        $this->flashMessage('Role updated successfully!', 'success');

        return $this->redirectTo($this->indexRoute);
    }

    public function show($id)
    {
        $this->verifyAuthorization("role_edit");
        $role = $this->roleService->getRoleById($id);
        $this->role_id = $role->id;
        $this->title = $role->title;
        $this->selectedPermissions = $role->permissions->pluck('title')->toArray();
        $this->currentPage = 'show';
    }
    public function delete($id)
    {
        $this->verifyAuthorization('role_delete');
        $this->roleService->deleteRole($id);

        $this->flashMessage('Role deleted successfully!', "success");
        return $this->redirectTo($this->indexRoute);
    }
    public function render()
    {
        $this->permissions = Permission::all();
        switch ($this->currentPage) {
            case 'create':
                return view('backend.admin.role.create', ['permissions' => $this->permissions]);
            case 'edit':
                return view('backend.admin.role.edit', ['permissions' => $this->permissions]);
            case 'show':
                return view('backend.admin.role.show', ['permissions' => $this->permissions]);
            default:
                return view('backend.admin.role.index', ['permissions' => $this->permissions], [
                    'roles' => $this->roleService->getPaginatedRole(5, $this->search),
                ]);
        }
    }
}
