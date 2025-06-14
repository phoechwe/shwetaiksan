<?php

namespace App\Livewire\Backend;

use App\Models\Role;
use App\Services\CustomerServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;
class TotalBalanceComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;
    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $title, $customer_id, $customer_name, $search,$name, $user_id, $currentUrl , $total_balance;
    protected $indexRoute = "admin/total-balance";
    protected $createRoute, $editRoute, $showRoute , $customerServices;

    public function boot(CustomerServices $customerServices)
    {
        $this->customerServices = $customerServices;
        abort_if(Gate::denies('total_balance_access'), Response::HTTP_FORBIDDEN, '403 FORBIDDEN');
    }

    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("total_balance_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }

    public function show($id)
    {
        $this->verifyAuthorization("total_balance_show");
        $user = $this->customerServices->getUserById($id);
        $this->customer_id = $user->id;
        $this->customer_name = $user->name;
        $this->total_balance = $user->total_balance;
        $this->currentPage = 'show';
    }
    public function render()
    {
        switch ($this->currentPage) {
            case 'create':
                return view('backend.admin.totalBalance.create', [
                    'availableRoles' => $this->availableRoles,
                ]);
            case 'edit':
                return view('backend.admin.totalBalance.edit', [
                    'availableRoles' => $this->availableRoles,
                ]);
            case 'show':
                return view('backend.admin.totalBalance.show', [
                    'payment_records' => $this->customerServices->getPaymentRecord($this->customer_id ,10),
                ]);
            default:
                return view('backend.admin.totalBalance.index', [
                    'users' => $this->customerServices->getAllUsers(10, $this->search),
                ]);
        }
    }
}
