<?php

namespace App\Livewire\Backend;

use App\Models\Withdrawl;
use App\Services\WithdrawlServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class WithdrawlComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;
    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $account_name, $account_number, $bank_account_id,$bank_type, $bank_name, $status, $customer_id, $customer_name, $search, $name, $user_id, $currentUrl, $amount, $created_at, $updated_at;
    protected $indexRoute = "admin/withdrawl";
    protected $createRoute, $editRoute, $showRoute, $withdrawlServices;
    public $statusFilter, $filterDate;

    public $confirmingPaidStatus = false;
    public $selectedWithdrawlId, $selectedAmount, $selectedAccountName, $selectedAccountNumber, $selectedBankType;
    public function boot(WithdrawlServices $withdrawlServices)
    {
        $this->withdrawlServices = $withdrawlServices;
        abort_if(Gate::denies('withdrawl_access'), Response::HTTP_FORBIDDEN, '403 FORBIDDEN');
    }
    public function show($id)
    {
        $this->verifyAuthorization("withdrawl_show");
        $withdrawl = $this->withdrawlServices->getWithdrawlGetId($id);
        $this->user_id = $withdrawl->user_id;
        $this->account_name = $withdrawl->account_name;
        $this->account_number = $withdrawl->account_number;
        $this->bank_account_id = $withdrawl->bank_account_id;
        $this->bank_type = $withdrawl->bankAccount->bank_type;
        $this->amount = $withdrawl->amount;
        $this->status = $withdrawl->status;
        $this->customer_name = $withdrawl->user->name;
        $this->created_at = $withdrawl->created_at;
        $this->updated_at = $withdrawl->updated_at;
        $this->currentPage = 'show';
    }
    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("withdrawl_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }
    public function confirmMarkAsPaid($id)
    {
        $this->selectedWithdrawlId = $id;
        $this->confirmingPaidStatus = true;
        $withdrawl = $this->withdrawlServices->getWithdrawlGetId($id);
        $this->selectedAmount = $withdrawl->amount;
        $this->selectedAccountName = $withdrawl->account_name;
        $this->selectedAccountNumber = $withdrawl->account_number;
        $this->selectedBankType = $withdrawl->bankAccount->bank_type;
    }

    // Actually mark the deposit as paid
    public function markAsPaid($type)
    {
        $this->withdrawlServices->calculateTotalWithdrawl($this->selectedWithdrawlId ,$type , $this->selectedAmount);
        $this->flashMessage('Paid successfully!', 'success');
        session()->flash('type', 'success');
        $this->confirmingPaidStatus = false;
    }


    public function filterStatus() {}
    public function render()
    {
        switch ($this->currentPage) {
            case 'list':
                return view('backend.admin.withdrawl.index', [
                    'withdrawls' => $this->withdrawlServices->getAllWithdrawl(50, $this->filterDate, $this->statusFilter, $this->search)
                ]);
            case 'edit':
                return view('backend.admin.withdrawl.edit', []);
            case 'show':
                return view('backend.admin.withdrawl.show', []);
        }
    }
}
