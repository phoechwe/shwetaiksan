<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TwodThreedRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LuckySpinController extends Controller
{
    public function luckySpin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);

        $user = auth()->user();
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'data' => (object) [],
            ], 200);
        }

        $twodThreedRecord = TwodThreedRecord::create([
            'number' => "Lucky Spin",
            'amount' => $request->amount,
            'type' =>  3,
            'status' =>  3,
            'user_id' => $user->id,
        ]);
        $user->total_balance += $request->amount;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Lucky Spin Created Successfully',
            'data' => $twodThreedRecord,
        ]);
    }
}
