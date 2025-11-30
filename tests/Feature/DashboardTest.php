<?php

namespace Tests\Feature;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * Test that unauthenticated users are redirected to login.
     */
    public function test_unauthenticated_users_are_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    /**
     * Test that dashboard route is named correctly.
     */
    public function test_dashboard_route_is_named_correctly(): void
    {
        $this->assertEquals('/dashboard', route('dashboard', [], false));
    }
}
