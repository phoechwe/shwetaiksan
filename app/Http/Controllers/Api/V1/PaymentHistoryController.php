<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DepositRequest;
use App\Models\Withdrawl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentHistoryController extends Controller
{
    public function getPaymentHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'payment_type' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'data' => []
            ], 200);
        }

        if ($request->payment_type == 2) {
            $withdrawals = Withdrawl::where('user_id', $request->user_id)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Withdrawal history retrieved successfully',
                'data' => $withdrawals
            ]);
        } else {
            $deposits = DepositRequest::where('user_id', $request->user_id)->get();//for asdc 

            return response()->json([
                'status' => 200,
                'message' => 'Deposit history retrieved successfully',
                'data' => $deposits
            ]);
        }
    }
}
