<?php

namespace Tests\Unit\Models\ShippingMethods;

use App\Cart\Money;
use App\Models\Country;
use App\Models\ShippingMethod;
use Tests\TestCase;

class ShippingMethodTest extends TestCase
{
    public function testItBelongsToManyCountries()
    {
        $shipping = factory(ShippingMethod::class)->create();

        $shipping->countries()->attach(
            factory(Country::class)->create()
        );

        $this->assertInstanceOf(Country::class, $shipping->countries->first());
    }

    public function testItReturnsAMoneyInstanceForThePrice()
    {
        $shipping = factory(ShippingMethod::class)->create();

        $this->assertInstanceOf(Money::class, $shipping->price);
    }

    public function testItReturnsAFormattedPrice()
    {
        $shipping = factory(ShippingMethod::class)->create([
            'price' => 0,
        ]);

        $this->assertEquals($shipping->formattedPrice, '£0.00');
    }
}
