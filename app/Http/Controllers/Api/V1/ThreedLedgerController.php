<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ThreedLedger;
use App\Models\ThreedLedgerNumber;
use App\Models\ThreedNumber;
use App\Models\Twodledger;
use App\Models\Twodnumber;
use App\Models\TwodledgerNumber;
use App\Models\TwodThreedRecord;
use App\Repositories\TwodledgerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreedLedgerController extends Controller
{
    public function allNumber()
    {
        date_default_timezone_set('Asia/Yangon');

        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $threedLedger = ThreedLedger::where(function ($query) use ($currentDate, $currentTime) {
            $query->where('end_date', '>', $currentDate)
                ->orWhere(function ($q) use ($currentDate, $currentTime) {
                    $q->where('end_date', $currentDate)
                        ->where('end_time', '>=', $currentTime); 
                });
        })->where('status' ,1)->first();


        if (!$threedLedger) {
            return response()->json([
                'status' => 404,
                'message' => 'No active Three D Ledger found for now.',
                'data' => [],
            ]);
        }

        $threedNumbers = ThreedNumber::orderBy('number')->get();

        $data = $threedNumbers->map(function ($number) use ($threedLedger) {
            $currentAmount = ThreedLedgerNumber::where('threed_ledger_id', $threedLedger->id)
                ->where('threed_number_id', $number->id)
                ->sum('amount');

            return [
                'id' => $number->id,
                'number' => $number->number,
                'limit_amount' => $threedLedger->amount,
                'left_amount' => max($threedLedger->amount - $currentAmount, 0),
                'is_full' => $currentAmount >= $threedLedger->amount ? 1 : 0,
            ];
        })->toArray();

        return response()->json([
            'status' => 200,
            'message' => 'List of Three D Numbers with Limits',
            'data' => $data,
        ]);
    }

    public function threedBet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bets' => 'required|array|min:1',
            'bets.*.amount' => 'required|numeric|min:1',
            'bets.*.threed_number_id' => 'required|exists:threed_numbers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'data' => []
            ], 200);
        }

        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        // Find active Two D Ledger
        $threedLedger = ThreedLedger::where(function ($query) use ($currentDate, $currentTime) {
            $query->where('end_date', '>', $currentDate)
                ->orWhere(function ($q) use ($currentDate, $currentTime) {
                    $q->where('end_date', $currentDate)
                        ->where('end_time', '>=', $currentTime);
                });
        })->first();

        if (!$threedLedger) {
            return response()->json([
                'status' => 404,
                'message' => 'No active Two D Ledger found for now.',
                'data' => []
            ]);
        }

        $currentAmount = auth()->user()->total_balance;
        $betTotalAmount = 0;
        $totalAmount = 0;

        // Loop through bets and store them
        foreach ($request->bets as $bet) {
            $totalAmount += $bet['amount'];
        }

        if ($totalAmount > $currentAmount) {
            return response()->json([
                'status' => 400,
                'message' => 'Insufficient balance to place the bets.',
                'data' => []
            ]);
        }

        foreach ($request->bets as $bet) {
            $betTotalAmount += $bet['amount'];
            $createdBets[] = ThreedLedgerNumber::create([
                'threed_ledger_id' => $threedLedger->id,
                'threed_number_id' => $bet['threed_number_id'],
                'amount' => $bet['amount'],
                'date' => $currentDate,
                'user_id' => auth()->id(),
            ]);

            $towodThreedRecord = TwodThreedRecord::create([
                'number' => $bet['number'],
                'amount' => $bet['amount'],
                'type' =>  2,
                'status' =>  1,
                'user_id' => auth()->id(),
            ]);
        }

        $user = auth()->user();
        $user->total_balance -= $betTotalAmount;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Three D bets placed successfully.',
            'data' => [],
        ]);
    }
}
