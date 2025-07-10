<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Twodledger;
use App\Models\Twodnumber;
use App\Models\TwodledgerNumber;
use App\Models\TwodThreedRecord;
use App\Repositories\TwodledgerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TwodledgerController extends Controller
{
    public function allNumber()
    {
        date_default_timezone_set('Asia/Yangon');

        $currentdate = date('Y-m-d');
        $currentTime = date('H:i:s');

        $twodLedger = Twodledger::where('date', $currentdate)
            ->where('end_time', '>=', $currentTime)
            ->first();

        if (!$twodLedger) {
            return response()->json([
                'status' => 404,
                'message' => 'No active Two D Ledger found for now.',
                'data' => [],
            ]);
        }

        $twodNumbers = Twodnumber::orderBy('number')->get();

        $data = $twodNumbers->map(function ($number) use ($twodLedger) {
            $currentAmount = TwodledgerNumber::where('two_d_ledger_id', $twodLedger->id)
                ->where('two_d_number_id', $number->id)
                ->sum('amount');

            return [
                'id' => $number->id,
                'number' => $number->number,
                'limit_amount' => $twodLedger->amount,
                'left_amount' => $twodLedger->amount - $currentAmount,
                'is_full' => $currentAmount >= $twodLedger->amount ? 1 : 0,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'List of Two D Numbers with Limits',
            'data' => $data,
        ]);
    }

    public function twodBet(Request $request)
    {
        date_default_timezone_set('Asia/Yangon');

        $validator = Validator::make($request->all(), [
            'bets' => 'required|array|min:1',
            'bets.*.amount' => 'required|numeric|min:1',
            'bets.*.twod_number_id' => 'required|exists:twodnumbers,id',
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
        $twodLedger = Twodledger::where('date', $currentDate) //Need start time and isPaid this ledger 
            ->where('end_time', '>=', $currentTime)
            ->first();

        if (!$twodLedger) {
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
            $createdBets[] = TwodledgerNumber::create([
                'two_d_ledger_id' => $twodLedger->id,
                'two_d_number_id' => $bet['twod_number_id'],
                'amount' => $bet['amount'],
                'date' => $currentDate,
                'user_id' => auth()->id(),
            ]);

            $towodThreedRecord = TwodThreedRecord::create([
                'number' => $bet['number'],
                'amount' => $bet['amount'],
                'type' =>  1,
                'status' =>  1,
                'user_id' => auth()->id(),
            ]);
        }

        $user = auth()->user();
        $user->total_balance -= $betTotalAmount;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Two D bets placed successfully.',
            'data' => [],
        ]);
    }
}
