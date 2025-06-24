<?php

use App\Livewire\Backend\BankAccountComponent;
use App\Livewire\Backend\UserComponent;
use App\Livewire\Backend\PermissionComponent;
use App\Livewire\Backend\RoleComponent;
use App\Livewire\Backend\CustomerComponent;
use App\Livewire\Backend\DepositRequestComponent;
use App\Livewire\Backend\PaymentRecordComponent;
use App\Livewire\Backend\ThreedLedgerComponent;
use App\Livewire\Backend\TotalBalanceComponent;
use App\Livewire\Backend\TwoDledgerComponent;
use App\Livewire\Backend\WithdrawlComponent;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified',])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('backend/dashboard');
    })->name('dashboard');
    Route::get('users/{action?}/{id?}',UserComponent::class)->name('users');

    Route::get('permission/{action?}/{id?}',PermissionComponent::class)->name('permission');

    Route::get('role/{action?}/{id?}',RoleComponent::class)->name('role');

    // Customer Routes
    Route::get('customer/{action?}/{id?}',CustomerComponent::class)->name('customer');

    // Total Balance Routes
    Route::get('total-balance/{action?}/{id?}',TotalBalanceComponent::class)->name('total-balance');

    // Bank Account Routes
    Route::get('bank-account/{action?}/{id?}',BankAccountComponent::class)->name('bank-account');

    // Deposit Request Routes
    Route::get('deposit-request/{action?}/{id?}',DepositRequestComponent::class)->name('deposit-request');

    // Withdrawl Routes
    Route::get('withdrawl/{action?}/{id?}',WithdrawlComponent::class)->name('withdrawl');

    // Payment Record
    Route::get('payment-record/{action?}/{id?}',PaymentRecordComponent::class)->name('payment-record');

    // Two D Ledger
    Route::get('two-d-ledger/{action?}/{id?}',TwoDledgerComponent::class)->name('two-d-ledger');

    // Two D Ledger
    Route::get('threed-ledger/{action?}/{id?}',ThreedLedgerComponent::class)->name('threed-ledger');

    // Two D Bet
    Route::get('two-d-bet/{action?}/{id?}', \App\Livewire\Backend\TwodBetComponent::class)->name('two-d-bet');

    //Two D Three D Record
    Route::get('twod-threed-record/{action?}/{id?}', \App\Livewire\Backend\TwodThreedRecordComponent::class)->name('twod-threed-record');
});


