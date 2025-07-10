<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PaymentRecord;
use App\Models\User;
use App\Models\Withdrawl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

        $LatestWithdraw = Withdrawl::where('user_id', $request->user_id)->latest('created_at')->first();
        if ($LatestWithdraw) {
            if ($LatestWithdraw->status == 1) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Dont success process',
                    'data' => (object) [],
                ], 200);
            }
        }

        $withdrawl = Withdrawl::create($request->all());
        DB::transaction(function () use ($withdrawl) {
            $withdrawl->status = 1;
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
