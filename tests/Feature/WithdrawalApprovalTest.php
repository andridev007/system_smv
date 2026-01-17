<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WithdrawalApprovalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that admin can view withdrawals page with user data.
     */
    public function test_admin_can_view_withdrawals_with_user_data(): void
    {
        $user = User::factory()->create(['name' => 'Test User']);
        $admin = User::factory()->create();
        
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'amount' => 100.00,
        ]);

        $response = $this->actingAs($admin)->get('/admin/withdrawals');

        $response->assertStatus(200);
        $response->assertSee('Test User');
        $response->assertSee('100.00');
        $response->assertSee('Pending');
    }

    /**
     * Test that withdrawal approval requires authentication.
     */
    public function test_withdrawal_approval_requires_authentication(): void
    {
        $user = User::factory()->create();
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        Storage::fake('public');
        $file = UploadedFile::fake()->image('proof.jpg');

        $response = $this->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'proof_image' => $file,
        ]);

        $response->assertRedirect('/login');
    }

    /**
     * Test that admin can approve withdrawal with proof upload.
     */
    public function test_admin_can_approve_withdrawal_with_proof(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['phone' => '1234567890']);
        $admin = User::factory()->create();
        
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
            'amount' => 100.00,
            'final_amount' => 95.00,
        ]);

        $file = UploadedFile::fake()->image('proof.jpg');

        $response = $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'proof_image' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Assert the withdrawal was updated
        $withdrawal->refresh();
        $this->assertEquals('completed', $withdrawal->status);
        $this->assertNotNull($withdrawal->proof_image);

        // Assert file was stored
        Storage::disk('public')->assertExists($withdrawal->proof_image);
    }

    /**
     * Test that proof image is required for approval.
     */
    public function test_proof_image_is_required_for_approval(): void
    {
        $user = User::factory()->create();
        $admin = User::factory()->create();
        
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", []);

        $response->assertSessionHasErrors(['proof_image']);
    }

    /**
     * Test that only image files are accepted.
     */
    public function test_only_image_files_accepted_for_proof(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $admin = User::factory()->create();
        
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'proof_image' => $file,
        ]);

        $response->assertSessionHasErrors(['proof_image']);
    }

    /**
     * Test that withdrawal status changes to completed after approval.
     */
    public function test_withdrawal_status_changes_to_completed(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['phone' => '1234567890']);
        $admin = User::factory()->create();
        
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $this->assertEquals('pending', $withdrawal->status);

        $file = UploadedFile::fake()->image('proof.jpg');

        $this->actingAs($admin)->post("/admin/withdrawals/{$withdrawal->id}/approve", [
            'proof_image' => $file,
        ]);

        $withdrawal->refresh();
        $this->assertEquals('completed', $withdrawal->status);
    }

    /**
     * Test that isCompleted method works correctly.
     */
    public function test_is_completed_method(): void
    {
        $user = User::factory()->create();
        
        $pendingWithdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        
        $completedWithdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'completed',
        ]);

        $this->assertFalse($pendingWithdrawal->isCompleted());
        $this->assertTrue($completedWithdrawal->isCompleted());
    }

    /**
     * Test that completed withdrawals display correctly in view.
     */
    public function test_completed_withdrawals_display_in_view(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['name' => 'Jane Doe', 'phone' => '1234567890']);
        $admin = User::factory()->create();
        
        $withdrawal = Withdrawal::factory()->create([
            'user_id' => $user->id,
            'status' => 'completed',
            'proof_image' => 'withdrawal_proofs/proof_123.jpg',
        ]);

        // Create a fake proof file
        Storage::disk('public')->put('withdrawal_proofs/proof_123.jpg', 'fake content');

        $response = $this->actingAs($admin)->get('/admin/withdrawals');

        $response->assertStatus(200);
        $response->assertSee('Completed');
        $response->assertSee('View Proof');
    }
}
