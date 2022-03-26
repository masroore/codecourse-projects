<?php

namespace Tests\Feature\PaymentMethods;

use App\Models\User;
use Tests\TestCase;

class PaymentMethodStoreTest extends TestCase
{
    public function testItFailsIfNotAuthenticated()
    {
        $this->json('POST', 'api/payment-methods')
            ->assertStatus(401);
    }

    public function testItRequireAToken()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/payment-methods')
            ->assertJsonValidationErrors(['token']);
    }

    public function testItCanSuccessfullyAddACard()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa',
        ]);

        $this->assertDatabaseHas('payment_methods', [
            'user_id' => $user->id,
            'card_type' => 'Visa',
            'last_four' => '4242',
        ]);
    }

    public function testItReturnsTheCreatedCard()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa',
        ])
            ->assertJsonFragment([
                'card_type' => 'Visa',
            ]);
    }

    public function testItSetsTheCreatedCardAsDefault()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa',
        ]);

        $this->assertDatabaseHas('payment_methods', [
            'id' => json_decode($response->getContent())->data->id,
            'default' => true,
        ]);
    }
}
