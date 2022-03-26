<?php

namespace Tests\Unit\Models\Addresses;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class AddressTest extends TestCase
{
    public function testItHasOneCountry()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(Country::class, $address->country);
    }

    public function testItBelongsToAUser()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(User::class, $address->user);
    }

    public function testItSetsOldAddressesToNotDefaultWhenCreating()
    {
        $user = factory(User::class)->create();

        $oldAddress = factory(Address::class)->create([
            'default' => true,
            'user_id' => $user->id,
        ]);

        factory(Address::class)->create([
            'default' => true,
            'user_id' => $user->id,
        ]);

        $this->assertFalse($oldAddress->fresh()->default);
    }
}
