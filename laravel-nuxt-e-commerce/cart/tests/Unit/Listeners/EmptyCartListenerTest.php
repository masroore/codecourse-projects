<?php

namespace Tests\Unit\Listeners;

use App\Cart\Cart;
use App\Listeners\Order\EmptyCart;
use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class EmptyCartListenerTest extends TestCase
{
    public function testItShouldClearTheCart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create()
        );

        $listener = new EmptyCart($cart);

        $listener->handle();

        $this->assertEmpty($user->cart);
    }
}
