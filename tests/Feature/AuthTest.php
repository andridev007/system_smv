<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Test that the login page is accessible.
     */
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test that the register page is accessible.
     */
    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /**
     * Test that login page contains expected form elements.
     */
    public function test_login_page_contains_form_elements(): void
    {
        $response = $this->get('/login');

        $response->assertSee('Username');
        $response->assertSee('Password');
        $response->assertSee('Login');
        $response->assertSee('Register');
    }

    /**
     * Test that register page contains expected form elements.
     */
    public function test_register_page_contains_form_elements(): void
    {
        $response = $this->get('/register');

        $response->assertSee('Full Name');
        $response->assertSee('Email');
        $response->assertSee('Username');
        $response->assertSee('Phone Number');
        $response->assertSee('Password');
        $response->assertSee('Confirm Password');
        $response->assertSee('Referral Code');
        $response->assertSee('Register');
        $response->assertSee('Login');
    }
}
