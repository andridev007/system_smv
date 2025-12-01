<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MootaController extends Controller
{
    /**
     * Handle webhook from Moota.co for automated deposit verification.
     */
    public function handleWebhook(Request $request): JsonResponse
    {
        $mutations = $request->input('data', $request->all());

        if (! is_array($mutations)) {
            $mutations = [$mutations];
        }

        // Handle array of mutations or single mutation object
        if (isset($mutations['mutation'])) {
            $mutations = [$mutations];
        }

        $processedCount = 0;

        foreach ($mutations as $mutation) {
            // Extract amount from mutation data
            // Moota sends amount as a positive number for credits
            $amount = $mutation['amount'] ?? $mutation['credit'] ?? null;
            $type = $mutation['type'] ?? $mutation['mutation_type'] ?? 'CR';

            // Only process credit (incoming) transactions
            if ($type !== 'CR' && $type !== 'credit') {
                continue;
            }

            if (! $amount || $amount <= 0) {
                continue;
            }

            // Find pending deposit matching the total_amount
            $deposit = Deposit::where('status', 'pending')
                ->where('total_amount', $amount)
                ->first();

            if ($deposit) {
                DB::transaction(function () use ($deposit) {
                    // Update deposit status to approved
                    $deposit->update(['status' => 'approved']);

                    // Update user's balance
                    $user = $deposit->user;
                    $user->increment('balance', $deposit->amount);
                });

                Log::info('Deposit auto-approved via Moota webhook', [
                    'deposit_id' => $deposit->id,
                    'user_id' => $deposit->user_id,
                    'amount' => $deposit->amount,
                    'total_amount' => $deposit->total_amount,
                ]);

                $processedCount++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Processed {$processedCount} deposit(s)",
        ]);
    }
}
