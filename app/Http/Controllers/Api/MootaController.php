<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MootaController extends Controller
{
    /**
     * Handle the callback from Moota.
     */
    public function handleCallback(Request $request): JsonResponse
    {
        $amount = $request->input('amount');

        if (!$amount) {
            return response()->json([
                'success' => false,
                'message' => 'Amount is required',
            ]);
        }

        $deposit = Deposit::where('status', 'pending')
            ->where('amount_total', $amount)
            ->first();

        if (!$deposit) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found',
            ]);
        }

        $deposit->update(['status' => 'approved']);

        $user = $deposit->user;
        $user->increment('balance', $deposit->amount);

        return response()->json([
            'success' => true,
        ]);
    }
}
