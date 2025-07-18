<?php

namespace App\Services;

use App\Models\Twodledger;
use App\Models\TwodledgerNumber;
use App\Models\Twodnumber;
use App\Repositories\TwodledgerRepository;

class TwodledgerServices
{
    private TwodledgerRepository $twodledgerRepository;
    private $currentDate;
    private $currentTime;
    public function __construct(TwodledgerRepository $twodledgerRepository)
    {
        $this->twodledgerRepository = $twodledgerRepository;
        date_default_timezone_set('Asia/Yangon');
        $this->currentDate = date('Y-m-d');
        $this->currentTime = date('H:i:s');
    }

    public function getTodayLedger()
    {
        $currentDate = $this->currentDate;
        $twodLedger = Twodledger::whereDate('date', $currentDate)
            ->orderBy('created_at' , 'DESC')
            ->first();
        return $twodLedger;
    }
    public function createTwodledger($data)
    {
        return $this->twodledgerRepository->createData($data);
    }

    public function getTwodledgerById($id)
    {
        return $this->twodledgerRepository->getById($id);
    }

    public function updateTwodledger($id, $data)
    {
        return $this->twodledgerRepository->updateData($id, $data);
    }
    public function getAllTwodledgers($perPage = 40, $filter, $search = "")
    {
        $query = [
            "search" => $search,
            "with" => [
                "twodledgerNumbers.twodnumber"
            ],
            "search_columns" => [
                "id",
                "user_id",
                "account_name",
                "account_number",
                "amount",
                "created_at"
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

        return $this->twodledgerRepository->paginateData($perPage, $query);
    }

    public function getAllTwodNumbers()
    {
        $twodNumbers = Twodnumber::all();
        return $twodNumbers->map(function ($twodNumber) {
            return [
                'id' => $twodNumber->id,
                'number' => $twodNumber->number,
            ];
        });
    }

    // public function calculateTotalCurrentAmount($ledgerId) // Calculate the total current amount for a given ledger
    // {
    //     $totalCurrentAmount = 0;
    //     $twodLedger = Twodledger::with('twodledgerNumbers')->find($ledgerId)->first();
    //     foreach ($twodLedger->twodledgerNumbers as $ledgerNumber) {
    //         $totalCurrentAmount += $ledgerNumber->amount;
    //     }
    //     return $totalCurrentAmount;
    // }

    public function calculateIndividualBetAmount($numberValue, $ledgerId)
    {
        $number = Twodnumber::where('number', $numberValue)->first();
        if (!$number) {
            return 0;
        }
        return TwodledgerNumber::where('two_d_ledger_id', $ledgerId)
            ->where('two_d_number_id', $number->id)
            ->sum('amount');
    }


    public function getTwoDLedgerNumberBalance($ledgerId)
    {
        $twodLedger = Twodledger::with('twodledgerNumbers')->find($ledgerId);
        $allNumbers = Twodnumber::orderBy('number')->get();

        $ledgerNumbers = TwodledgerNumber::where('two_d_ledger_id', $ledgerId)->get()->keyBy('two_d_number_id');

        return $allNumbers->map(function ($number) use ($ledgerNumbers, $twodLedger) {
            $totalBetAmount = $this->calculateIndividualBetAmount($number->number, $twodLedger->id);
            $matched = $ledgerNumbers->get($number->id);
            return [
                'number' => $number->number,
                'limit_amount' => $twodLedger->amount,
                'total' => $matched?->current_amount ?? 0,
                'total_bet_amount' => $totalBetAmount,
                'is_full' => $matched?->is_full ?? false,
                'date' => $twodLedger->date,
                'session_time' => $twodLedger->session_time,
            ];
        });
    }
}
