<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function testItRequiresAName()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['name']);
    }

    public function testItRequiresAEmail()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['email']);
    }

    public function testItRequiresAValidEmail()
    {
        $this->json('POST', 'api/auth/register', [
            'email' => 'nope',
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function testItRequiresAUniqueEmail()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/register', [
            'email' => $user->email,
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function testItRequiresAPassword()
    {
        $this->json('POST', 'api/auth/register')
            ->assertJsonValidationErrors(['password']);
    }

    public function testItRegistersAUser()
    {
        $this->json('POST', 'api/auth/register', [
            'name' => $name = 'Alex',
            'email' => $email = 'alex@codecourse.com',
            'password' => 'secret',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name' => $name,
        ]);
    }

    public function testItReturnsAUserOnRegistration()
    {
        $this->json('POST', 'api/auth/register', [
            'name' => 'Alex',
            'email' => $email = 'alex@codecourse.com',
            'password' => 'secret',
        ])
            ->assertJsonFragment([
                'email' => $email,
            ]);
    }
}
