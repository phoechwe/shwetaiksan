<?php

namespace App\Services;

use App\Models\PaymentRecord;
use App\Models\User;
use App\Repositories\DepositRequestRepository;
use App\Repositories\UserRepository;
use App\Repositories\WithdrawlRepository;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Database;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WithdrawlServices
{
    private WithdrawlRepository $withdrawlRepository;
    public function __construct(WithdrawlRepository $withdrawlRepository)
    {
        $this->withdrawlRepository = $withdrawlRepository;
    }
    public function createWithdrawl($data)
    {
        return $this->withdrawlRepository->createData($data);
    }

    public function getWithdrawlGetId($id)
    {

        $query = ['user', 'bankAccount'];
        return $this->withdrawlRepository->getById($id, $query);
    }

    public function updateWithdrawl($id, $data)
    {
        return $this->withdrawlRepository->updateData($id, $data);
    }

    public function deleteWithdrawl($id)
    {
        return $this->withdrawlRepository->deleteData($id);
    }

    public function getAllWithdrawl($perPage = 40,$filterDate, $filter, $search = "")
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
            ],

            "search_columns" => [
                "id",
                "user_id",
                "account_name",
                "bank_type",
                "account_number",
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
        return $this->withdrawlRepository->paginateData($perPage, $query);
    }

    public function calculateTotalWithdrawl($id)
    {
        $withdrawl = \App\Models\Withdrawl::find($id);
        if ($withdrawl->status == 1) {
            DB::transaction(function () use ($withdrawl) {
                $withdrawl->status = 2;
                $withdrawl->save();

                PaymentRecord::create([
                    'user_id' => $withdrawl->user_id,
                    'amount' => $withdrawl->amount,
                    'account_number' => $withdrawl->account_number,
                    'account_name' => $withdrawl->account_name,
                    'balance_type' => 2,
                ]);

                $user = User::find($withdrawl->user_id);
                $user->total_balance = $user->total_balance - $withdrawl->amount;
                $user->update();
            });
        }
    }
}
