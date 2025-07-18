<?php

namespace App\Services;

use App\Models\ThreedLedger;
use App\Models\ThreedLedgerNumber;
use App\Models\ThreedNumber;
use App\Models\Twodledger;
use App\Models\TwodledgerNumber;
use App\Models\Twodnumber;
use App\Repositories\ThreedLedgerRepository;
use App\Repositories\TwodledgerRepository;

class ThreedLedgerServices
{
    private ThreedLedgerRepository $threedLedgerRepository;
    private $currentDate;
    private $currentTime;
    public function __construct(ThreedLedgerRepository $threedLedgerRepository)
    {
        $this->threedLedgerRepository = $threedLedgerRepository;
        date_default_timezone_set('Asia/Yangon');
        $this->currentDate = date('Y-m-d');
        $this->currentTime = date('H:i:s');
    }

    public function getTodayLedger()
    {
        $currentDate = $this->currentDate;
        $threedLedger = ThreedLedger::where('start_date', "<=", $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->orderBy('created_at', 'DESC')
            ->first();
        return $threedLedger;
    }
    public function createThreedledger($data)
    {
        return $this->threedLedgerRepository->createData($data);
    }

    public function getThreedLedgerById($id)
    {
        return $this->threedLedgerRepository->getById($id);
    }

    public function updateThreedledger($id, $data)
    {
        return $this->threedLedgerRepository->updateData($id, $data);
    }
    public function getAllThreedLedgers($perPage = 40, $filter, $search = "")
    {
        $query = [
            "search" => $search,
            // "with" => [
            //     "twodledgerNumbers.twodnumber"
            // ],
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

        return $this->threedLedgerRepository->paginateData($perPage, $query);
    }

    public function getAllThreeNumbers()
    {
        $threedNumbers = ThreedNumber::all();
        return $threedNumbers->map(function ($threedNumber) {
            return [
                'id' => $threedNumber->id,
                'number' => $threedNumber->number,
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

    /**
     * Calculate the total bet amount for a specific number in a ledger.
     *
     * @param string $numberValue
     * @param int $ledgerId
     * @return int
     */
    public function calculateIndividualBetAmount($numberValue, $ledgerId)
    {
        $number = ThreedNumber::where('number', $numberValue)->first();
        if (!$number) {
            return 0;
        }
        return ThreedLedgerNumber::where('threed_ledger_id', $ledgerId)
            ->where('threed_number_id', $number->id)
            ->sum('amount');
    }

    /**
     * Get the balance of each number in a specific ledger.
     * For Show Page
     * @param int $ledgerId
     * @return \Illuminate\Support\Collection
     */

    public function getThreedLedgerNumberBalance($ledgerId)
    {
        $threedLedger = ThreedLedger::with('threedLedgerNumbers')->find($ledgerId);
        $allNumbers = ThreedNumber::orderBy('number')->get();

        $ledgerNumbers = ThreedLedger::where('id', $ledgerId)->get()->keyBy('threed_number_id');

        return $allNumbers->map(function ($number) use ($ledgerNumbers, $threedLedger) {
            $totalBetAmount = $this->calculateIndividualBetAmount($number->number, $threedLedger->id);
            $matched = $ledgerNumbers->get($number->id);
            return [
                'number' => $number->number,
                'limit_amount' => $threedLedger->amount,
                'total' => $matched?->current_amount ?? 0,
                'total_bet_amount' => $totalBetAmount,
                'is_full' => $matched?->is_full ?? false,
                'start_date' => $threedLedger->start_date,
                'end_date' => $threedLedger->end_date,
                'end_time' => $threedLedger->end_time,
            ];
        });
    }
}
