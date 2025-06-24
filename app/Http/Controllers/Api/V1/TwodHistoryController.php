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

class TwodHistoryController extends Controller
{
    public function TwodHistory()
    {
        $user = auth()->user();
        $twodHistory = TwodThreedRecord::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        if ($twodHistory->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No Two D History found for this user.',
                'data' => [],
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'List of Two D History',
            'data' => $twodHistory,
        ]);
    }
}
