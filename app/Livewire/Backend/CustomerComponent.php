<?php

namespace App\Livewire\Backend;

use App\Services\CustomerServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class CustomerComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;
    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $title, $customer_id, $customer_name, $search,$name, $password, $user_id, $currentUrl, $role_title , $phone_no;
    protected $indexRoute = "admin/customer";
    protected $createRoute, $editRoute, $showRoute, $customerServices;
    public function boot(CustomerServices $customerServices)
    {
        $this->customerServices = $customerServices;
        $this->authorizeAccess('permission_access');
    }

    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("customer_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }


    public function create()
    {
        $this->verifyAuthorization("customer_create");
        $this->resetPage();
        $this->currentPage = "create";
    }


    public function store()
    {
        $this->verifyAuthorization("customer_create");
        $user = $this->customerServices->createUser([
            'name' => $this->name,
            'phone_no' => $this->phone_no,
            'password' => $this->password
        ]);

        $user->roles()->sync(3);
        $this->flashMessage('User created successfully!', 'success');
        return $this->redirectTo($this->indexRoute);
    }

    public function edit($id)
    {
        $this->verifyAuthorization('user_edit');
        $user = $this->customerServices->getUserById($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->phone_no = $user->phone_no;
        $this->password = '';
        $this->currentPage = 'edit';
    }

    public function update()
    {
        $this->verifyAuthorization('user_edit');
        $user = $this->customerServices->getUserById($this->user_id);
        $user = $this->customerServices->updateUser($this->user_id, [
            'name' => $this->name,
            'phone_no' => $this->phone_no,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
        ]);
        $user->roles()->sync(3);
        $this->flashMessage('User updated successfully!', 'success');
        
        return $this->redirectTo($this->indexRoute);
    }


    private function show($id)
    {
        $this->verifyAuthorization("user_show");
        $user = $this->customerServices->getUserById($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->phone_no = $user->phone_no;
        $this->currentPage = 'show';
    }
    public function delete($id)
    {
        $this->verifyAuthorization("user_delete");
        $this->customerServices->deleteUser($id);
        $this->flashMessage('User deleted successfully!', 'success');
        return $this->redirectTo($this->indexRoute);
    }



    public function render()
    {
        switch ($this->currentPage) {
            case 'list':
                return view('backend.admin.customer.index', [
                    'customers' => $this->customerServices->getAllUsers(5, $this->search)
                ]);
            case 'create':
                return view('backend.admin.customer.create');
            case 'edit':
                return view('backend.admin.customer.edit', [
                    // 'customer' => $this->customerServices->getCustomerById($this->customer_id)
                ]);
            case 'show':
                return view('backend.admin.customer.show', [
                    // 'customer' => $this->customerServices->getCustomerById($this->customer_id)
                ]);
        }
    }
}
