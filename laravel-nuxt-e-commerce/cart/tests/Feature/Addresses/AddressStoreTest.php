<?php

namespace Tests\Feature\Addresses;

use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class AddressStoreTest extends TestCase
{
    public function testItFailsIfAuthenticated()
    {
        $this->json('POST', 'api/addresses')
            ->assertStatus(401);
    }

    public function testItRequiresAName()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['name']);
    }

    public function testItRequiresAddressLineOne()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['address_1']);
    }

    public function testItRequiresACity()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['city']);
    }

    public function testItRequiresAPostalCode()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['postal_code']);
    }

    public function testItRequiresACountry()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors(['country_id']);
    }

    public function testItRequiresAValidCountry()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses', [
            'country_id' => 1,
        ])
            ->assertJsonValidationErrors(['country_id']);
    }

    public function testItStoresAnAddress()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses', $payload = [
            'name' => 'Alex Garrett-Smith',
            'address_1' => '123 Code Street',
            'city' => 'London',
            'postal_code' => 'CO1234',
            'country_id' => factory(Country::class)->create()->id,
        ]);

        $this->assertDatabaseHas('addresses', array_merge($payload, [
            'user_id' => $user->id,
        ]));
    }

    public function testItReturnsAnAddressWhenCreated()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/addresses', $payload = [
            'name' => 'Alex Garrett-Smith',
            'address_1' => '123 Code Street',
            'city' => 'London',
            'postal_code' => 'CO1234',
            'country_id' => factory(Country::class)->create()->id,
        ]);

        $response->assertJsonFragment([
            'id' => json_decode($response->getContent())->data->id,
        ]);
    }
}
