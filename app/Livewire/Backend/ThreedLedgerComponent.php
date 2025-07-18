<?php

namespace App\Livewire\Backend;

use App\Services\ThreedLedgerServices;
use App\Services\TwodledgerServices;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;

class ThreedLedgerComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $search = '', $ledger_id, $amount,$end_time, $start_date , $end_date , $created_date, $currentUrl, $total_balance, $todayLedgerPaid , $status;
    protected $indexRoute = "admin/threed-ledger";
    protected $createRoute, $editRoute, $showRoute, $threedLedgerServices;


    public function boot(ThreedLedgerServices $threedLedgerServices)
    {
        $this->threedLedgerServices = $threedLedgerServices;
        $this->todayLedgerPaid = $threedLedgerServices->getTodayLedger()->status ?? null;
        abort_if(Gate::denies('total_balance_access'), Response::HTTP_FORBIDDEN, '403 FORBIDDEN');
    }

    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("threed_ledger_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }
    public function show($id)
    {
        $this->verifyAuthorization("threed_ledger_show");
        $ledger = $this->threedLedgerServices->getThreedLedgerById($id);
        $this->ledger_id = $ledger->id;
        $this->start_date = $ledger->start_date;
        $this->end_date = $ledger->end_date;
        $this->amount = $ledger->amount;
        $this->end_time = $ledger->end_time;
        $this->currentPage = 'show';
    }
    public function create()
    {
        if ($this->todayLedgerPaid != 1) {
            $this->verifyAuthorization("threed_ledger_create");
            $this->currentPage = 'create';
        } else {
            $this->flashMessage('ယနေ့ Ledger အတွက်မလျော်ရသေးပါ.', 'error');
            $this->redirect($this->indexRoute);
        }
    }

    public function store()
    {
        $this->verifyAuthorization("threed_ledger_create");
        $this->threedLedgerServices->createThreedledger([
            'amount' => $this->amount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'end_time' => $this->end_time,
            'status' =>   1,
        ]);

        $this->flashMessage('Ledger Created successfully.', 'Success');
        $this->redirect($this->indexRoute);
    }
    public function edit($id)
    {
        $this->verifyAuthorization("threed_ledger_edit");
        $ledger = $this->threedLedgerServices->getThreedLedgerById($id);
        $this->ledger_id = $ledger->id;
        $this->start_date = $ledger->start_date;
        $this->end_date = $ledger->end_date;
        $this->amount = $ledger->amount;
        $this->end_time = $ledger->end_time;
        $this->currentPage = 'edit';
    }
    public function update()
    {
        $this->verifyAuthorization("threed_ledger_edit");
        $this->threedLedgerServices->updateThreedledger($this->ledger_id, [
            'amount' => $this->amount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'end_time' => $this->end_time,
        ]);
        $this->flashMessage('Updated successfully!', 'success');
        session()->flash('type', 'success');

        return $this->redirectTo($this->indexRoute);;
    }

    public function destory($id)
    {
        $this->verifyAuthorization("threed_ledger_delete");
        $ledger = $this->threedLedgerServices->getThreedLedgerById($id);
        if ($ledger) {
            $ledger->delete();
            $this->flashMessage('Deleted successfully!', 'success');
            session()->flash('type', 'success');
            return $this->redirectTo($this->indexRoute);;
        } else {
            $this->flashMessage('Ledger not found!', 'error');
        }
    }
    public function render()
    {
        switch ($this->currentPage) {
            case 'create':
                return view('backend.admin.threedLedger.create', [
                    'sessionTime' => config('constant.session_time'),
                ]);
            case 'edit':
                return view('backend.admin.threedLedger.edit');
            case 'show':
                return view('backend.admin.threedLedger.show', [
                    'threedledgerNumberBalances' => $this->threedLedgerServices->getThreedLedgerNumberBalance($this->ledger_id),
                ]);
            default:
                return view('backend.admin.threedLedger.index', [
                    'twodledgers' => $this->threedLedgerServices->getAllThreedLedgers(40, $this->search),
                ]);
        }
    }
}
