<?php

namespace App\Services;

use App\Models\PaymentRecord;
use App\Models\User;
use App\Repositories\DepositRequestRepository;
use App\Repositories\UserRepository;
use Illuminate\Container\Attributes\Database;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DepositRequestServices
{
    private DepositRequestRepository $depositRequestRepository;
    public function __construct(DepositRequestRepository $depositRequestRepository)
    {
        $this->depositRequestRepository = $depositRequestRepository;
    }
    public function createUser($data)
    {
        return $this->depositRequestRepository->createData($data);
    }

    public function getDepositById($id)
    {

        $query = ['user', 'bankAccount'];
        return $this->depositRequestRepository->getById($id, $query);
    }

    public function updateDeposit($id, $data)
    {
        return $this->depositRequestRepository->updateData($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->depositRequestRepository->deleteData($id);
    }

    public function getAllDeposits($perPage = 40, $filterDate, $filter, $search = "")
    {
        $todayStart = now()->startOfDay(); // 2025-05-12 00:00:00
        $todayEnd = now()->endOfDay();
        $query = [
            "search" => $search,
            "with"  => ["user", "bankAccount"],
            "where_between" => [
                "created_at" => [$todayStart, $todayEnd]
            ],
            "or_where" => [
                ['status', '=', 1],
                ['status', '=', 2],
                ['status', '=', 3],
            ],
            "search_columns" => [
                "id",
                "user_id",
                "working_number",
                "amount",
                "status",
                "created_at"
            ],
        ];

        if (!empty($filterDate)) {
            $start = Carbon::parse($filterDate)->startOfDay();
            $end = Carbon::parse($filterDate)->endOfDay();
            $query["where_between"] = [
                "created_at" => [$start, $end]
            ];
        }
        // if $filter is provided, assign to where
        if (!empty($filter)) {
            $query = [
                "where" => [
                    "status" => $filter,
                ],
            ];
        }
        return $this->depositRequestRepository->paginateData($perPage, $query);
    }

    public function calculateTotalDeposit($id)
    {
        $deposit = \App\Models\DepositRequest::find($id);
        if ($deposit->status == 1) {
            DB::transaction(function () use ($deposit) {
                $deposit->status = 2;
                $deposit->save();

                PaymentRecord::create([
                    'user_id' => $deposit->user_id,
                    'amount' => $deposit->amount,
                    'account_number' => $deposit->account_number,
                    'account_name' => $deposit->account_name,
                    'balance_type' => 1,
                ]);

                $user = User::find($deposit->user_id);
                $user->total_balance = $user->total_balance + $deposit->amount;
                $user->update();
            });
        }
    }
}
