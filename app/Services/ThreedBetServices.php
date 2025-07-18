<?php

namespace App\Services;

use App\Models\ThreedLedger;
use App\Models\ThreedLedgerNumber;
use App\Models\Twodledger;
use App\Models\TwodledgerNumber;
use App\Models\TwodThreedRecord;
use App\Models\User;
use App\Repositories\DepositRequestRepository;
use App\Repositories\PaymentRecordRepository;
use App\Repositories\ThreedBetRepository;
use App\Repositories\TwodBetRepository;
use App\Repositories\UserRepository;
use Illuminate\Container\Attributes\Database;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ThreedBetServices
{
    private $threedBetRepository;
    public $currentDate, $currentTime;
    private $user;
    private $threedLedger;
    /**
     * TwodbetServices constructor.
     *
     * @param ThreedBetRepository $threedBetRepository
     */
    public function __construct(ThreedBetRepository $threedBetRepository, ThreedLedger $threedLedger, User $user)
    {
        $this->threedLedger = $threedLedger;
        $this->threedBetRepository = $threedBetRepository;
        date_default_timezone_set('Asia/Yangon');
        $this->currentDate = date('Y-m-d');
        $this->currentTime = date('H:i:s');
        $this->user = $user;
    }

    public function getThreedBetGetId($id)
    {
        $query = ['user'];
        return $this->threedBetRepository->getById($id, $query);
    }

    public function deleteLedger($id)
    {
        return $this->threedBetRepository->deleteData($id);
    }

    public function getThreedLedger()
    {
        $currentDate = $this->currentDate;
        $currentTime = $this->currentTime;
        $threedLedger = ThreedLedger::where('start_date', "<=", $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->orderBy('created_at', 'DESC')
            ->first();
        return $threedLedger;
    }

    public function getAllRecord($perPage = 40, $filterDate, $statusFilter, $search = "")
    {
        $threedLedger = $this->getThreedLedger();
        $query = [
            "search" => $search,
            "with"   => ["user", "twodledger", "twodnumber"],

            "search_columns" => [
                "id",
                "amount",
                "created_at"
            ]
        ];

        $query = [
            "where" => [
                "threed_ledger_id" =>  $threedLedger->id ?? 0
            ],
        ];

        if (!empty($filterDate)) {
            $query = [
                "where" => [
                    "date" => [$filterDate]
                ],
            ];
        }

        if (!empty($statusFilter)) {
            $query["where_has"]["twodledger"] = [
                ['session_time', '=', $statusFilter]
            ];
        }

        return $this->threedBetRepository->paginateData($perPage, $query);
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

    public function calculateWinAmount($userId, $amount, $number, $percentage)
    {
        $user = $this->user->find($userId);
        $winAmount = $amount * $percentage;
        $user->total_balance += $winAmount;
        $user->save();

        $towodThreedRecord = TwodThreedRecord::create([
            'number' => $number,
            'amount' => $winAmount,
            'type' =>  1,
            'status' =>  2,
            'user_id' => $user->id,
        ]);
    }
    public function winThreedNumber($number, $percentage, $ledgerId)
    {
        $currentDate = $this->currentDate;
        $currentTime = $this->currentTime;
        $ledgerNumbers = ThreedLedgerNumber::where('threed_ledger_id', $ledgerId)
            ->whereHas('threedNumber', function ($query) use ($number) {
                $query->where('number', $number);
            })->with('threedNumber')
            ->get();
        foreach ($ledgerNumbers as $ledger) {
            $this->calculateWinAmount($ledger->user_id, $ledger->amount, $ledger->threedNumber->number, $percentage);
        }
        $ledger = $this->threedLedger->find($ledgerId);
        $ledger->status = 2;
        $ledger->save();

        return $ledgerNumbers;
    }
}
