<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankAccountController extends Controller
{
    public function getBankAccount(Request$request)
    {
         $validator = Validator::make($request->all(), [
            'bank_account_id' => 'required|numeric',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                // 'errors' => $validator->errors(),
                'data' => (object) [],
            ], 200);
        }

        $bankAccount = BankAccount::find($request->bank_account_id);
        return response()->json([
            'status' => 200,
            'message' => 'Get Bank Account Successfully',
            'data' => $bankAccount,
        ]);
    }
}
