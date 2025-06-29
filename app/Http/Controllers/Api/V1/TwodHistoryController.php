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

    public function TwodTopList()
    {
        $records = TwodThreedRecord::where('status', 2)
            ->where('type', 1) // Assuming 1 is for 2D
            ->selectRaw('user_id, SUM(amount) as total_amount')
            ->groupBy('user_id')
            ->orderByDesc('total_amount')
            ->take(10)
            ->with('user:id,name')
            ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No top list found.',
                'data' => [],
            ]);
        }

        // Custom format the response
        $topList = $records->map(function ($item) {
            return [
                'user_id' => $item->user_id,
                'total_amount' => (int) $item->total_amount, // force string if needed
                'user_name' => optional($item->user)->name,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'Twod Top 10 List',
            'data' => $topList,
        ]);
    }
    public function ThreedTopList()
    {
        $records = TwodThreedRecord::where('status', 2)
            ->where('type', 2) // Assuming 1 is for 2D
            ->selectRaw('user_id, SUM(amount) as total_amount')
            ->groupBy('user_id')
            ->orderByDesc('total_amount')
            ->take(10)
            ->with('user:id,name')
            ->get();

        if ($records->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No top list found.',
                'data' => [],
            ]);
        }

        // Custom format the response
        $topList = $records->map(function ($item) {
            return [
                'user_id' => $item->user_id,
                'total_amount' => (int) $item->total_amount, // force string if needed
                'user_name' => optional($item->user)->name,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => 'Threed Top 10 List',
            'data' => $topList,
        ]);
    }
}
