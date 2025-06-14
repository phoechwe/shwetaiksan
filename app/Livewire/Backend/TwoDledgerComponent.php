<?php

namespace App\Livewire\Backend;

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

class TwoDledgerComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $search = '', $ledger_id, $amount, $start_time, $end_time, $session_time, $date, $created_date, $currentUrl, $total_balance, $todayLedgerPaid;
    protected $indexRoute = "admin/two-d-ledger";
    protected $createRoute, $editRoute, $showRoute, $twodlegerServices;


    public function boot(TwodledgerServices $twodlegerServices)
    {
        $this->twodlegerServices = $twodlegerServices;
        $this->todayLedgerPaid = $twodlegerServices->getTodayLedger()->isPaid ?? null;
        abort_if(Gate::denies('total_balance_access'), Response::HTTP_FORBIDDEN, '403 FORBIDDEN');
    }

    public function mount()
    {
        $this->createRoute = "{$this->indexRoute}/create";
        $this->editRoute = "{$this->indexRoute}/edit/*";
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("two_d_ledger_access");
        $this->determineCurrentPage([
            $this->createRoute => "create",
            $this->editRoute => "edit",
            $this->showRoute => "show"
        ]);
    }
    public function show($id)
    {
        $this->verifyAuthorization("two_d_ledger_show");
        $ledger = $this->twodlegerServices->getTwodledgerById($id);
        $this->ledger_id = $ledger->id;
        $this->date = $ledger->date;
        $this->session_time = $ledger->session_time;
        $this->amount = $ledger->amount;
        $this->start_time = $ledger->start_time;
        $this->end_time = $ledger->end_time;
        $this->currentPage = 'show';
    }
    public function create()
    {
        if ($this->todayLedgerPaid != 1) {
            $this->verifyAuthorization("two_d_ledger_create");
            $this->currentPage = 'create';
        } else {
            $this->flashMessage('ယနေ့ Ledger အတွက်မလျော်ရသေးပါ.', 'error');
            $this->redirect($this->indexRoute);
        }
    }

    public function store()
    {
        $this->verifyAuthorization("two_d_ledger_create");
        $this->twodlegerServices->createTwodledger([
            'amount' => $this->amount,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'session_time' => $this->session_time,
            'date' => $this->date,
        ]);

        $this->flashMessage('User created successfully.', 'Success');
        $this->redirect($this->indexRoute);
    }
    public function edit($id)
    {
        $this->verifyAuthorization("two_d_ledger_edit");
        $ledger = $this->twodlegerServices->getTwodledgerById($id);
        $this->ledger_id = $ledger->id;
        $this->date = $ledger->date;
        $this->session_time = $ledger->session_time;
        $this->amount = $ledger->amount;
        $this->start_time = $ledger->start_time;
        $this->end_time = $ledger->end_time;
        $this->currentPage = 'edit';
    }
    public function update()
    {
        $this->verifyAuthorization("two_d_ledger_edit");
        $this->twodlegerServices->updateTwodledger($this->ledger_id, [
            'amount' => $this->amount,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'session_time' => $this->session_time,
            'date' => $this->date,
        ]);
        $this->flashMessage('Updated successfully!', 'success');
        session()->flash('type', 'success');

        return $this->redirectTo($this->indexRoute);;
    }

    public function destory($id)
    {
        $this->verifyAuthorization("two_d_ledger_delete");
        $ledger = $this->twodlegerServices->getTwodledgerById($id);
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
                return view('backend.admin.twoDledger.create', [
                    'sessionTime' => config('constant.session_time'),
                ]);
            case 'edit':
                return view('backend.admin.twoDledger.edit', [
                    'sessionTime' => config('constant.session_time'),
                ]);
            case 'show':
                return view('backend.admin.twoDledger.show', [
                    'twodledgerNumberBalances' => $this->twodlegerServices->getTwoDLedgerNumberBalance($this->ledger_id),
                ]);
            default:
                return view('backend.admin.twoDledger.index', [
                    'twodledgers' => $this->twodlegerServices->getAllTwodledgers(40, $this->search),
                ]);
        }
    }
}
