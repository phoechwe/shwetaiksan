<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\DepositRequestRepository;
use App\Repositories\PaymentRecordRepository;
use App\Repositories\UserRepository;
use Illuminate\Container\Attributes\Database;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PaymentRecordServices
{
    private PaymentRecordRepository $paymentRecordRepository;
    public function __construct(PaymentRecordRepository $paymentRecordRepository)
    {
        $this->paymentRecordRepository = $paymentRecordRepository;
    }
    public function createPaymentRecord($data)
    {
        return $this->paymentRecordRepository->createData($data);
    }

    public function getPymentRecordRequestGetId($id)
    {

        $query = ['user'];
        return $this->paymentRecordRepository->getById($id, $query);
    }

    public function deleteUser($id)
    {
        return $this->paymentRecordRepository->deleteData($id);
    }

    public function getAllRecord($perPage = 40, $filter, $search = "")
    {
        $query = [
            "search" => $search,
            "with"   => "user",
            "search_columns" => [
                "id",
                "user_id",
                "account_name",
                "account_number",
                "amount",
                "created_at"
            ],
            "or_where" => [
                ['balance_type', '=', 1],
                ['balance_type', '=', 2],
                ['balance_type', '=', 3],
            ],
        ];
    
        // if $filter is provided, assign to where
        if (!empty($filter)) {
            $query = [
                "where" => [
                    "balance_type" => $filter,
                ],
            ];
        }
    
        return $this->paymentRecordRepository->paginateData($perPage, $query);
    }

    public function filterStatus() {}

    public function calculateTotalDeposit($id)
    {
        $deposit = \App\Models\DepositRequest::find($id);
        if ($deposit->status == 1) {
            $deposit->status = 2;
            $deposit->update();
        }
        $user = User::find($deposit->user_id);
        $user->total_balance = $user->total_balance + $deposit->amount;
        $user->update();
    }
}
