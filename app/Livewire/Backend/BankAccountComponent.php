<?php

namespace App\Livewire\Backend;

use App\Models\BankAccount;
use App\Traits\AuthorizeRequests;
use App\Traits\HandleFlashMessage;
use App\Traits\HandlePageState;
use App\Traits\HandleRedirections;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class BankAccountComponent extends Component
{
    use WithPagination, WithoutUrlPagination, AuthorizeRequests, HandleRedirections, HandlePageState, HandleFlashMessage;

    #[Layout('backend.layouts.app')]

    public $currentPage = 'list', $bank_account_id,$bank_type ,$account_number,$youtube_link ,$bank_name, $title, $currentUrl;
    public $search = '';

    protected $indexRoute = "admin/bank-account";
    protected $createRoute, $editRoute, $showRoute;
    public function boot( )
    {
        $this->authorizeAccess('bank_account_access');
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
        $this->verifyAuthorization("bank_account_show");
        $this->bank_account_id = $id;
        $this->currentPage = 'show';
    }
    public function edit($id)
    {
        $this->verifyAuthorization("bank_account_edit");
        $bankAccount = BankAccount::find($id);
        $this->bank_account_id = $bankAccount->id;
        $this->account_number = $bankAccount->account_number;
        $this->youtube_link = $bankAccount->youtube_link;
        $this->bank_name = $bankAccount->bank_name;
        $this->bank_type = $bankAccount->bank_type;
        $this->currentPage = 'edit';
    }
    public function update()
    {
        $this->verifyAuthorization("bank_account_edit");
        $this->validate([
            'account_number' => 'required|max:255',
            'bank_name' => 'required|string|max:255',
        ]);
        $bankAccount = BankAccount::find($this->bank_account_id);
        $bankAccount->account_number = $this->account_number;
        $bankAccount->youtube_link = $this->youtube_link;
        $bankAccount->bank_name = $this->bank_name;
        $bankAccount->bank_type = $this->bank_type;
        $bankAccount->update();
        $this->flashMessage('Bank account updated successfully!.', 'success');
        return $this->redirectTo($this->indexRoute);    }
    public function delete($id)
    {
        $this->verifyAuthorization("bank_account_delete");
        // Delete logic here
        $this->flashMessage('success', 'Bank account deleted successfully.');
        $this->redirect($this->indexRoute);
    }
    public function render()
    {
        switch ($this->currentPage) {
            case 'create':
                return view('backend.admin.bankAccount.create', );
            case 'edit':
                return view('backend.admin.bankAccount.edit', );
            case 'show':
                return view('backend.admin.bankAccount.show', );
            default:
                return view('backend.admin.bankAccount.index',  [
                    'bank_accounts' => BankAccount::paginate(10),
                 ]);
        }
    }

}
