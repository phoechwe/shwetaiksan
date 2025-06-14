<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Withdrawl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class WithdrawlController extends Controller
{
    public function withdrawlRequest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'account_number' => 'required',
            'account_name' => 'required|string',
            'bank_account_id' => 'required',
            'user_id' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'data' => (object) [],
            ], 200);
        }

        $user = auth()->user();
        if($user->total_balance < $request->amount){
            return response()->json([
                'status' => 400,
                'message' => 'Insufficient Balance',
                'data' => (object) [],
            ], 200);
        }
        
        $withdrawl = Withdrawl::create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Withdrawl Request Created Successfully',
            'data' => $withdrawl,
        ]);
    }

    public function twodAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'two_d_id' => 'required',
            'number' => 'required|string'
        ]);

         if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'data' => (object) [],
            ], 200);
        }

    }
}
