<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * Test that unauthenticated users are redirected to login for admin dashboard.
     */
    public function test_admin_dashboard_requires_authentication(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the admin dashboard.
     */
    public function test_authenticated_users_can_access_admin_dashboard(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /**
     * Test that admin dashboard contains expected data.
     */
    public function test_admin_dashboard_contains_expected_data(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewHas([
            'totalUsers',
            'pendingDeposits',
            'pendingWithdrawals',
            'totalDeposits',
            'totalWithdrawals',
            'totalRevenue',
        ]);
    }

    /**
     * Test that admin dashboard contains expected UI elements.
     */
    public function test_admin_dashboard_contains_ui_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertSee('Total Users');
        $response->assertSee('Pending Deposits');
        $response->assertSee('Pending Withdrawals');
        $response->assertSee('Quick Actions');
    }

    /**
     * Test that unauthenticated users are redirected to login for admin users page.
     */
    public function test_admin_users_requires_authentication(): void
    {
        $response = $this->get('/admin/users');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the admin users page.
     */
    public function test_authenticated_users_can_access_admin_users(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.index');
    }

    /**
     * Test that admin users page contains expected elements.
     */
    public function test_admin_users_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertSee('Manage Users');
        $response->assertSee('Manage all registered users');
    }

    /**
     * Test that unauthenticated users are redirected to login for admin deposits page.
     */
    public function test_admin_deposits_requires_authentication(): void
    {
        $response = $this->get('/admin/deposits');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the admin deposits page.
     */
    public function test_authenticated_users_can_access_admin_deposits(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/deposits');

        $response->assertStatus(200);
        $response->assertViewIs('admin.deposits.index');
    }

    /**
     * Test that admin deposits page contains expected elements.
     */
    public function test_admin_deposits_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/deposits');

        $response->assertSee('Manage Deposits');
        $response->assertSee('Approve');
        $response->assertSee('Reject');
        $response->assertSee('Pending');
    }

    /**
     * Test that unauthenticated users are redirected to login for admin withdrawals page.
     */
    public function test_admin_withdrawals_requires_authentication(): void
    {
        $response = $this->get('/admin/withdrawals');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the admin withdrawals page.
     */
    public function test_authenticated_users_can_access_admin_withdrawals(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/withdrawals');

        $response->assertStatus(200);
        $response->assertViewIs('admin.withdrawals.index');
    }

    /**
     * Test that admin withdrawals page contains expected elements.
     */
    public function test_admin_withdrawals_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/withdrawals');

        $response->assertSee('Manage Withdrawals');
        $response->assertSee('Approve');
        $response->assertSee('Pending');
    }

    /**
     * Test that unauthenticated users are redirected to login for admin settings page.
     */
    public function test_admin_settings_requires_authentication(): void
    {
        $response = $this->get('/admin/settings');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the admin settings page.
     */
    public function test_authenticated_users_can_access_admin_settings(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/settings');

        $response->assertStatus(200);
        $response->assertViewIs('admin.settings');
    }

    /**
     * Test that admin settings page contains expected elements.
     */
    public function test_admin_settings_page_contains_expected_elements(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/settings');

        $response->assertSee('Admin Settings');
        $response->assertSee('General Settings');
        $response->assertSee('Investment Settings');
        $response->assertSee('Referral Settings');
        $response->assertSee('Payment Settings');
    }
}
