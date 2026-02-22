<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with stats.
     */
    public function index()
    {
        // Statistics for admin dashboard
        $totalUsers = 0;
        $totalDeposits = 0.00; // Total Approved Deposits
        $pendingDeposits = 0;
        $totalWithdrawals = 0.00; // Total Paid Withdrawals
        $pendingWithdrawals = 0;

        // Recent activity (dummy data for now)
        $recentActivity = [];

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDeposits',
            'pendingDeposits',
            'totalWithdrawals',
            'pendingWithdrawals',
            'recentActivity'
        ));
    }

    /**
     * Display all registered users.
     */
    public function users()
    {
        // Dummy data for users list
        $users = [];

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display deposit requests.
     */
    public function deposits()
    {
        // Dummy data for deposits list
        $deposits = [];

        return view('admin.deposits.index', compact('deposits'));
    }

    /**
     * Display withdrawal requests.
     */
    public function withdrawals()
    {
        // Fetch withdrawals with user relationships, ordered by most recent first
        $withdrawals = \App\Models\Withdrawal::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    /**
     * Display admin settings.
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Approve withdrawal and upload proof.
     */
    public function approveWithdraw(\Illuminate\Http\Request $request, $id)
    {
        $withdrawal = \App\Models\Withdrawal::with('user')->findOrFail($id);

        // Validate the request
        $request->validate([
            'proof_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle proof image upload
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $filename = 'proof_' . time() . '_' . $id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('withdrawal_proofs', $filename, 'public');
            
            // Update withdrawal with proof and status
            $withdrawal->proof_image = $path;
            $withdrawal->status = 'completed';
            $withdrawal->save();

            // Send WhatsApp notification
            $this->sendWhatsAppNotification($withdrawal);

            return redirect()->back()->with('success', 'Withdrawal approved and marked as completed. User has been notified via WhatsApp.');
        }

        return redirect()->back()->with('error', 'Failed to upload proof image.');
    }

    /**
     * Send WhatsApp notification to user.
     */
    private function sendWhatsAppNotification(\App\Models\Withdrawal $withdrawal)
    {
        // Get WhatsApp API credentials from environment
        $apiKey = env('WHATSAPP_API_KEY');
        $apiUrl = env('WHATSAPP_API_URL');

        // If WhatsApp is not configured, log and skip
        if (!$apiKey || !$apiUrl) {
            \Log::warning('WhatsApp API not configured. Skipping notification for withdrawal #' . $withdrawal->id);
            return;
        }

        $user = $withdrawal->user;
        $phone = $user->phone;

        // Format phone number (remove any non-numeric characters)
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Prepare message
        $message = "Hello {$user->name},\n\n";
        $message .= "Your withdrawal request #WD{$withdrawal->id} has been COMPLETED!\n\n";
        $message .= "Amount: $" . number_format($withdrawal->final_amount, 2) . "\n";
        $message .= "The transfer has been processed and proof has been uploaded.\n\n";
        $message .= "Thank you for using our service!";

        // Send WhatsApp message using API
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'phone' => $phone,
                    'message' => $message,
                ],
            ]);

            \Log::info('WhatsApp notification sent for withdrawal #' . $withdrawal->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send WhatsApp notification: ' . $e->getMessage());
        }
    }
}
