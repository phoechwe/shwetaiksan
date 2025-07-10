<?php

namespace App\Livewire\Backend;

use App\Models\TwodThreedRecord;
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

class TwodThreedRecordComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]
    public $currentPage = 'list', $ledger_id, $amount, $start_time, $end_time, $session_time, $date, $created_date, $currentUrl, $total_balance;
    protected $indexRoute = "admin/twod-threed-record";
    protected $createRoute, $editRoute, $showRoute, $twodlegerServices;
    public $statusFilter, $filterDate , $search = '' ;


    public function boot(TwodledgerServices $twodlegerServices)
    {
        $this->twodlegerServices = $twodlegerServices;
        abort_if(Gate::denies('twod_threed_record_access'), Response::HTTP_FORBIDDEN, '403 FORBIDDEN');
    }

    public function mount()
    {
        $this->showRoute = "{$this->indexRoute}/show/*";

        $this->authorizeAccess("two_d_ledger_access");
        $this->determineCurrentPage([
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
    public function filterStatus() {}

    public function render()
    {
        switch ($this->currentPage) {
            case 'show':
                return view('backend.admin.twodThreedRecord.show', [
                    'twodledgerNumberBalances' => $this->twodlegerServices->getTwoDLedgerNumberBalance($this->ledger_id,$perPage = 40, $this->filterDate, $this->statusFilter, $search = ""),
                ]);
            default:
                return view('backend.admin.twodThreedRecord.index', [
                    'twodThreedRecords' => TwodThreedRecord::with('user')->orderBy('id', 'desc')->paginate(40),
                ]);
        }
    }
}
