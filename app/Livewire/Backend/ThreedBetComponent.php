<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\DepositRequest;
use App\Services\DepositRequestServices;
use App\Services\PaymentRecordServices;
use App\Services\ThreedBetServices;
use App\Services\TwodbetServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;


class ThreedBetComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;
    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $search, $record_id, $created_at, $updated_at, $account_name, $user_name, $currentUrl, $user_id, $amount, $status, $account_number, $number, $balance_type, $ledgerId;
    // For Filter
    public $statusFilter, $filterDate, $paidPercentage, $isPaid;
    //For Model box
    public $percentageAmount, $threedNumber, $currentdate, $currentTime;
    protected $indexRoute = "admin/threed-bet";
    protected $createRoute, $editRoute, $showRoute, $threedBetServices;
    public $paidStatus = false;
    public function boot(ThreedBetServices $threedBetServices)
    {
        date_default_timezone_set('Asia/Yangon');
        $this->currentdate = date('Y-m-d');
        $this->currentTime = date('H:i:s');

        $this->threedBetServices = $threedBetServices;
        $this->isPaid = $this->threedBetServices->getThreedLedger()->status ?? 2;
        $this->ledgerId = $this->threedBetServices->getThreedLedger()->id ?? null;
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
    public function confirmMarkAsPaid()
    {
        $this->paidStatus = true;
    }
    public function markAsPaid()
    {
        $this->threedBetServices->winThreedNumber($this->threedNumber, $this->percentageAmount, $this->ledgerId);
        $this->flashMessage('ငွေပေးလျော်မူ အောင်မြင်ပါသည်!', 'success');
        session()->flash('type', 'success');
        $this->paidStatus = false;
        return $this->redirect('threed-bet', navigate: true);
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
                return view('backend.admin.threedBet.index', [
                    'threedBets' => $this->threedBetServices->getAllRecord(50, $this->filterDate, $this->statusFilter, $this->search)
                ]);
            case 'show':
                return view('backend.admin.paymentRecord.show');
        }
    }
}
