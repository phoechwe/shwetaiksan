<?php

namespace App\Livewire\Backend;

use App\Models\DepositRequest;
use App\Services\DepositRequestServices;
use App\Services\PaymentRecordServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class PaymentRecordComponent extends Component
{

    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;
    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $search,$record_id,$created_at,$updated_at, $account_name, $user_name, $currentUrl, $user_id,$amount, $status ,$account_number ,$number,$balance_type,$start_date;
    public $statusFilter;
    protected $indexRoute = "admin/payment-record";
    protected $createRoute, $editRoute, $showRoute, $paymentRecordService;
    public function boot(PaymentRecordServices $paymentRecordService)
    {
        $this->paymentRecordService = $paymentRecordService;
        $this->authorizeAccess('payment_record_access');
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

     public function show($id)
    {
        $this->verifyAuthorization("payment_record_show");
        $paymentRecord = $this->paymentRecordService->getPymentRecordRequestGetId($id);
        $this->account_name = $paymentRecord->account_name;
        $this->account_number = $paymentRecord->account_number;
        $this->amount = $paymentRecord->amount;
        $this->balance_type = $paymentRecord->balance_type;
        $this->user_name = $paymentRecord->user->name;
        $this->created_at = $paymentRecord->created_at;
        $this->updated_at = $paymentRecord->updated_at;
        $this->currentPage = 'show';
    }
    public function filterStatus() {}

    public function render()
    {
        switch ($this->currentPage) {
            case 'list':
                return view('backend.admin.paymentRecord.index', [
                    'records' => $this->paymentRecordService->getAllRecord(50, $this->statusFilter ,$this->search)
                ]);
            case 'show':
                return view('backend.admin.paymentRecord.show');
        }
    }
}
