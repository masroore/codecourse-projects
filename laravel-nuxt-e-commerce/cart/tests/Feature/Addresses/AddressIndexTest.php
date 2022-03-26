<?php

namespace Tests\Feature\Addresses;

use App\Models\Address;
use App\Models\User;
use Tests\TestCase;

class AddressIndexTest extends TestCase
{
    public function testItFailsIfNotAuthenticated()
    {
        $this->json('GET', 'api/addresses')
            ->assertStatus(401);
    }

    public function testItShowsAddresses()
    {
        $user = factory(User::class)->create();

        $address = factory(Address::class)->create([
            'user_id' => $user->id,
        ]);

        $this->jsonAs($user, 'GET', 'api/addresses')
            ->assertJsonFragment([
                'id' => $address->id,
            ]);
    }
}
