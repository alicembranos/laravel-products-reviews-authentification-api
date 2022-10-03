<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /**
     * Test to check correct credentials when logging in
     *
     * @return void
     */
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
        $this->post('/api/auth/login', ['email' => $user->email, 'password' => 'password']);

        $this->assertAuthenticated();
    }

    /**
     * Test to check correct credentials when logging in
     *
     * @return void
     */
    public function test_users_can_not_authenticate_with_inv()
    {

        $user = User::factory()->create();
        $this->post('/api/auth/login', ['email' => $user->email, 'password' => 'wrong-password']);
        $this->assertGuest();
    }
}
