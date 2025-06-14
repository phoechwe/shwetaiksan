<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\DepositRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function depositRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'working_number' => 'required',
            'account_name' => 'required|string',
            'account_number' => 'required|string',
            'bank_account_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
                'data' => (object) [],
            ], 200);
        }

        $bankAccount = BankAccount::find($request->bank_account_id);

        if (!$bankAccount) {
            return response()->json([
                'status' => 404,
                'message' => 'Bank account not found',
                'data' => (object) [],
            ], 200);
        }

        // Build data to insert
        $data = $request->only([
            'amount',
            'working_number',
            'account_name',
            'account_number',
            'bank_account_id',
            'user_id',
        ]);

        $data['admin_bank_name'] = $bankAccount->bank_name;
        $data['admin_bank_number'] = $bankAccount->account_number;

        $depositRequest = DepositRequest::create($data);

        return response()->json([
            'status' => 200,
            'message' => 'Deposit Request Created Successfully',
            'data' => $depositRequest,
        ]);
    }

   
}
