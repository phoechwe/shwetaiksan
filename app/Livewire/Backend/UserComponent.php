<?php

namespace App\Livewire\Backend;

use App\Models\Role;
use App\Services\UserServices;
use App\Traits\HandleRedirections;
use App\Traits\HandlePageState;
use App\Traits\HandleFlashMessage;
use App\Traits\AuthorizeRequests;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $name, $email, $password, $user_id, $currentUrl, $role_title;
    public $roles = [], $availableRoles;
    public $roleFilter = '';
    public $search = '';

    protected $indexRoute = "admin/users";
    protected $createRoute, $editRoute, $showRoute;


    protected $userService;
    protected $roleService;

    public function boot(UserServices $userService)
    {
        $this->userService = $userService;
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 FORBIDDEN');
    }

    public function mount()
    {
        $this->availableRoles = Role::all();
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("user_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }

    public function create()
    {
        $this->verifyAuthorization("user_create");
        $this->resetPage();
        $this->currentPage = "create";
    }


    public function store()
    {
        $this->verifyAuthorization("permission_create");
        $user = $this->userService->createUser([
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'password' => $this->password
        ]);

        $user->roles()->sync($this->roles);
        $this->flashMessage('User created successfully!', 'success');
        return $this->redirectTo($this->indexRoute);
    }

    public function edit($id)
    {
        $this->verifyAuthorization('user_edit');
        $user = $this->userService->getUserById($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->roles = $user->roles->pluck('id')->toArray();
        $this->currentPage = 'edit';
    }

    public function update()
    {
        $this->verifyAuthorization('user_edit');
        $user = $this->userService->getUserById($this->user_id);
        $user = $this->userService->updateUser($this->user_id, [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
        ]);
        $user->roles()->sync($this->roles);
        $this->flashMessage('User updated successfully!', 'success');
        
        return $this->redirectTo($this->indexRoute);
    }


    private function show($id)
    {
        $this->verifyAuthorization("user_show");
        $user = $this->userService->getUserById($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_title = $user->roles->pluck('title')->toArray();
        $this->currentPage = 'show';
    }
    public function delete($id)
    {
        $this->verifyAuthorization("user_delete");
        $this->userService->deleteUser($id);
        $this->flashMessage( 'User deleted successfully!','success');
        return $this->redirectTo($this->indexRoute);
    }


    public function filterUsers()
    {
    }

    public function render()
    {
        switch ($this->currentPage) {
            case 'create':
                return view('backend.admin.user.create', [
                    'availableRoles' => $this->availableRoles,
                ]);
            case 'edit':
                return view('backend.admin.user.edit', [
                    'availableRoles' => $this->availableRoles,
                ]);
            case 'show':
                return view('backend.admin.user.show');
            default:
                return view('backend.admin.user.index', [
                    'availableRoles' => $this->availableRoles,
                    'users' => $this->userService->getAllUsers(10, $this->roleFilter, $this->search),
                ]);
        }
    }
}
