<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MootaWebhookController extends Controller
{
    /**
     * Handle incoming webhook from Moota.
     */
    public function handle(Request $request): JsonResponse
    {
        // Log incoming request for debugging
        Log::info('Moota Webhook received', [
            'payload' => $request->all(),
        ]);

        $mutations = $request->input('data', $request->all());

        // Handle both single mutation and array of mutations
        if (isset($mutations['amount'])) {
            $mutations = [$mutations];
        }

        foreach ($mutations as $mutation) {
            $this->processMutation($mutation);
        }

        return response()->json(['message' => 'Webhook processed'], 200);
    }

    /**
     * Process a single mutation from Moota.
     */
    protected function processMutation(array $mutation): void
    {
        $amount = $mutation['amount'] ?? 0;

        if ($amount <= 0) {
            Log::info('Moota Webhook: Skipping mutation with non-positive amount', [
                'amount' => $amount,
            ]);

            return;
        }

        // Find pending deposit where amount_total matches mutation amount
        $deposit = Deposit::where('status', 'pending')
            ->where('amount_total', $amount)
            ->first();

        if (! $deposit) {
            Log::info('Moota Webhook: No matching pending deposit found', [
                'amount' => $amount,
            ]);

            return;
        }

        // Update deposit status and save mutation data
        DB::transaction(function () use ($deposit, $mutation) {
            $deposit->update([
                'status' => 'approved',
                'gateway_id' => $mutation['mutation_id'] ?? $mutation['id'] ?? null,
                'json_response' => json_encode($mutation),
            ]);

            // Increment user's balance
            $user = User::find($deposit->user_id);
            if ($user) {
                $user->increment('balance', $deposit->amount);
            }

            Log::info('Moota Webhook: Deposit approved', [
                'deposit_id' => $deposit->id,
                'user_id' => $deposit->user_id,
                'amount' => $deposit->amount,
            ]);
        });
    }
}
