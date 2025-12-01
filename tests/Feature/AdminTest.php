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
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the admin dashboard.
     */
    public function test_authenticated_users_can_access_admin_dashboard(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /**
     * Test that admin dashboard displays statistics.
     */
    public function test_admin_dashboard_displays_statistics(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertViewHas([
            'totalUsers',
            'totalDeposits',
            'pendingDeposits',
            'totalWithdrawals',
            'pendingWithdrawals',
            'recentActivity',
        ]);
        $response->assertSee('Admin Dashboard');
        $response->assertSee('Total Users');
        $response->assertSee('Total Deposits (Approved)');
        $response->assertSee('Pending Deposits');
        $response->assertSee('Total Withdrawals (Paid)');
        $response->assertSee('Pending Withdrawals');
        $response->assertSee('Recent Activity');
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
     * Test that admin users page displays expected content.
     */
    public function test_admin_users_page_displays_content(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertSee('Manage Users');
        $response->assertSee('View and manage all registered users');
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
     * Test that admin deposits page displays expected content.
     */
    public function test_admin_deposits_page_displays_content(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/deposits');

        $response->assertStatus(200);
        $response->assertSee('Deposit Requests');
        $response->assertSee('Manage pending and completed deposit requests');
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
     * Test that admin withdrawals page displays expected content.
     */
    public function test_admin_withdrawals_page_displays_content(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/withdrawals');

        $response->assertStatus(200);
        $response->assertSee('Withdrawal Requests');
        $response->assertSee('Manage pending and completed withdrawal requests');
    }

    /**
     * Test that /admin/dashboard route works and returns dashboard view.
     */
    public function test_admin_dashboard_route_works(): void
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
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
}
