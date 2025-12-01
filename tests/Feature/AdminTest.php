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
     * Test that unauthenticated users are redirected to login for users page.
     */
    public function test_admin_users_requires_authentication(): void
    {
        $response = $this->get('/admin/users');

        $response->assertRedirect('/login');
    }

    /**
     * Test that unauthenticated users are redirected to login for deposits page.
     */
    public function test_admin_deposits_requires_authentication(): void
    {
        $response = $this->get('/admin/deposits');

        $response->assertRedirect('/login');
    }

    /**
     * Test that unauthenticated users are redirected to login for withdrawals page.
     */
    public function test_admin_withdrawals_requires_authentication(): void
    {
        $response = $this->get('/admin/withdrawals');

        $response->assertRedirect('/login');
    }

    /**
     * Test that unauthenticated users are redirected to login for settings page.
     */
    public function test_admin_settings_requires_authentication(): void
    {
        $response = $this->get('/admin/settings');

        $response->assertRedirect('/login');
    }

    /**
     * Test that authenticated users can access the settings page.
     * Settings page doesn't require database queries.
     */
    public function test_authenticated_users_can_access_admin_settings(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'ADMIN010',
        ]);

        $response = $this->actingAs($user)->get('/admin/settings');

        $response->assertStatus(200);
        $response->assertViewIs('admin.settings');
    }

    /**
     * Test that admin settings page contains expected UI elements.
     */
    public function test_admin_settings_contains_ui_elements(): void
    {
        $user = User::factory()->make([
            'referral_code' => 'ADMIN011',
        ]);

        $response = $this->actingAs($user)->get('/admin/settings');

        $response->assertSee('Settings');
        $response->assertSee('Settings Coming Soon');
    }

    /**
     * Test admin routes exist and have correct names.
     */
    public function test_admin_routes_exist(): void
    {
        $this->assertTrue(\Route::has('admin.dashboard'));
        $this->assertTrue(\Route::has('admin.users'));
        $this->assertTrue(\Route::has('admin.deposits'));
        $this->assertTrue(\Route::has('admin.withdrawals'));
        $this->assertTrue(\Route::has('admin.settings'));
        $this->assertTrue(\Route::has('admin.deposits.approve'));
        $this->assertTrue(\Route::has('admin.deposits.reject'));
        $this->assertTrue(\Route::has('admin.withdrawals.approve'));
        $this->assertTrue(\Route::has('admin.withdrawals.reject'));
    }
}
