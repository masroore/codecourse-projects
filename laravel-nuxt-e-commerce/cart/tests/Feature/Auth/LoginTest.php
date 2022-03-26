<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testItRequiresAnEmail()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['email']);
    }

    public function testItRequiresAPassword()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['password']);
    }

    public function testItReturnsAValidationErrorIfCredentialsDontMatch()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'nope',
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function testItReturnsATokenIfCredentialsDoMatch()
    {
        $user = factory(User::class)->create([
            'password' => 'cats',
        ]);

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'cats',
        ])
            ->assertJsonStructure([
                'meta' => [
                    'token',
                ],
            ]);
    }

    public function testItReturnsAUserIfCredentialsDoMatch()
    {
        $user = factory(User::class)->create([
            'password' => 'cats',
        ]);

        $this->json('POST', 'api/auth/login', [
            'email' => $user->email,
            'password' => 'cats',
        ])
            ->assertJsonFragment([
                'email' => $user->email,
            ]);
    }
}
