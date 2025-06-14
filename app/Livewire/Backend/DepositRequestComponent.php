<?php

namespace App\Livewire\Backend;

use App\Models\DepositRequest;
use App\Services\DepositRequestServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class DepositRequestComponent extends Component
{

    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;
    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $search, $deposit_request_id, $user_name, $currentUrl, $user_id, $account_name, $account_number, $bank_account_id, $working_number, $amount, $status, $created_at, $updated_at;
    public $selectedAmount, $selectedWorkingNumber, $selectedAccountName, $selectedAccountNumber;
    public $statusFilter , $filterDate;

    public $confirmingPaidStatus = false;
    public $selectedDepositId;

    protected $indexRoute = "admin/deposit-request";
    protected $createRoute, $editRoute, $showRoute, $depositRequestServices;
    public function boot(DepositRequestServices $depositRequestServices)
    {
        $this->depositRequestServices = $depositRequestServices;
        $this->authorizeAccess('deposit_request_access');
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

    public function confirmMarkAsPaid($id)
    {
        $this->selectedDepositId = $id;
        $this->confirmingPaidStatus = true;
        $deposit = DepositRequest::find($id);

        $this->selectedDepositId = $id;
        $this->selectedAmount = $deposit->amount;
        $this->selectedWorkingNumber = $deposit->working_number;
        $this->selectedAccountName = $deposit->account_name;
        $this->selectedAccountNumber = $deposit->account_number;
    }

    // Actually mark the deposit as paid
    public function markAsPaid()
    {
        $this->depositRequestServices->calculateTotalDeposit($this->selectedDepositId);

        $this->flashMessage('Paid successfully!', 'success');
        session()->flash('type', 'success');
        $this->confirmingPaidStatus = false;
    }
    public function markAsRejected()
    {
        $deposit = \App\Models\DepositRequest::find($this->selectedDepositId);
        if ($deposit && $deposit->status == 1) {
            $deposit->status = 3; // Rejected
            $deposit->update();

            $this->flashMessage('Rejected successfully!', 'danger');
            session()->flash('type', 'danger');
            $this->confirmingPaidStatus = false;
        }
    }

    public function edit($id)
    {
        $this->verifyAuthorization('deposit_request_edit');
        $depositRequest = $this->depositRequestServices->getDepositById($id);
        $this->deposit_request_id = $id;
        $this->user_id = $depositRequest->user_id;
        $this->account_name = $depositRequest->account_name;
        $this->account_number = $depositRequest->account_number;
        $this->bank_account_id = $depositRequest->bank_account_id;
        $this->amount = $depositRequest->amount;
        $this->status = $depositRequest->status;
        $this->user_name = $depositRequest->user->name;
        $this->working_number = $depositRequest->working_number;
        $this->currentPage = "edit";
    }
    public function update()
    {
        $this->verifyAuthorization("deposit_request_edit");
        $this->depositRequestServices->updateDeposit($this->deposit_request_id, [
            'user_id'   => $this->user_id,
            'from_bank' => $this->from_bank,
            'to_bank'   => $this->to_bank,
            'amount'    => $this->amount,
            'status'    => $this->status,
            'working_number' => $this->working_number,
        ]);

        $this->flashMessage('Deposit Request updated successfully!', 'success');
        session()->flash('type', 'success');

        return $this->redirectTo($this->indexRoute);
    }
    public function show($id)
    {
        $this->verifyAuthorization("deposit_request_show");
        $depositRequest = $this->depositRequestServices->getDepositById($id);
        $this->deposit_request_id = $id;
        $this->user_id = $depositRequest->user_id;
        $this->account_name = $depositRequest->account_name;
        $this->account_number = $depositRequest->account_number;
        $this->bank_account_id = $depositRequest->bank_account_id;
        $this->amount = $depositRequest->amount;
        $this->status = $depositRequest->status;
        $this->user_name = $depositRequest->user->name;
        $this->working_number = $depositRequest->working_number;
        $this->created_at = $depositRequest->created_at;
        $this->updated_at = $depositRequest->updated_at;
        $this->currentPage = 'show';
    }
    public function filterStatus() {}

    public function render()
    {
        switch ($this->currentPage) {
            case 'list':
                return view('backend.admin.depositRequest.index', [
                    'depositRequests' => $this->depositRequestServices->getAllDeposits(50,$this->filterDate, $this->statusFilter, $this->search)
                ]);
            case 'create':
                return view('backend.admin.depositRequest.create');
            case 'edit':
                return view('backend.admin.depositRequest.edit', []);
            case 'show':
                return view('backend.admin.depositRequest.show', []);
        }
    }
}
