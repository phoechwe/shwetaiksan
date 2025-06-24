<?php

namespace App\Services;

use App\Models\Twodledger;
use App\Models\TwodledgerNumber;
use App\Models\TwodThreedRecord;
use App\Models\User;
use App\Repositories\DepositRequestRepository;
use App\Repositories\PaymentRecordRepository;
use App\Repositories\TwodBetRepository;
use App\Repositories\UserRepository;
use Illuminate\Container\Attributes\Database;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TwodbetServices
{
    private TwodBetRepository $twodBetRepository;
    public $currentDate, $currentTime;
    private $user;
    private $twodLedger;
    /**
     * TwodbetServices constructor.
     *
     * @param TwodBetRepository $twodBetRepository
     */
    public function __construct(TwodBetRepository $twodBetRepository, Twodledger $twodLedger, User $user)
    {
        $this->twodLedger = $twodLedger;
        $this->twodBetRepository = $twodBetRepository;
        date_default_timezone_set('Asia/Yangon');
        $this->currentDate = date('Y-m-d');
        $this->currentTime = date('H:i:s');
        $this->user = $user;
    }

    public function getTwodBetGetId($id)
    {
        $query = ['user'];
        return $this->twodBetRepository->getById($id, $query);
    }

    public function deleteLedger($id)
    {
        return $this->twodBetRepository->deleteData($id);
    }

    public function getTwodLedger()
    {
        $currentDate = $this->currentDate;
        $currentTime = $this->currentTime;
        $twodLedger = Twodledger::whereDate('date', $currentDate)
            ->orderBy('created_at', 'DESC')
            ->first();
        return $twodLedger;
    }

    public function getAllRecord($perPage = 40, $filterDate, $statusFilter, $search = "")
    {
        $twodledgerId = $this->getTwodLedger();
        $query = [
            "search" => $search,
            "with"   => ["user", "twodledger", "twodnumber"],

            "search_columns" => [
                "id",
                "user_id",
                "amount",
                "created_at"
            ]
        ];

        //  if (!empty($filterDate)) {
        $query = [
            "where" => [
                "two_d_ledger_id" =>  $twodledgerId->id ?? 0
            ],
        ];
        // }

        // if $filter is provided, assign to where
        if (!empty($filterDate)) {
            $query = [
                "where" => [
                    "date" => [$filterDate]
                ],
            ];
        } else {
            // $query = [
            //     "where" => [
            //         "date" => [$this->currentDate]
            //     ],
            // ];
        }

        if (!empty($statusFilter)) {
            $query["where_has"]["twodledger"] = [
                ['session_time', '=', $statusFilter]
            ];
        }

        return $this->twodBetRepository->paginateData($perPage, $query);
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
    public function winTwodNumber($number, $percentage, $ledgerId)
    {
        $currentDate = $this->currentDate;
        $currentTime = $this->currentTime;

        $ledgerNumbers = TwodledgerNumber::where('two_d_ledger_id', $ledgerId)
            ->whereHas('twodnumber', function ($query) use ($number) {
                $query->where('number', $number);
            })->with('twodnumber')
            ->get();

        foreach ($ledgerNumbers as $ledger) {
            $this->calculateWinAmount($ledger->user_id, $ledger->amount, $ledger->twodnumber->number, $percentage);
        }
        $ledger = $this->twodLedger->find($ledgerId);
        $ledger->isPaid = 2;
        $ledger->save();

        return $ledgerNumbers;
    }
}
