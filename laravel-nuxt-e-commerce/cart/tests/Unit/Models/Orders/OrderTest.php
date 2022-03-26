<?php

namespace Tests\Unit\Models\Orders;

use App\Cart\Money;
use App\Models\Address;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ProductVariation;
use App\Models\ShippingMethod;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testItHasADefaultStatusOfPending()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertEquals($order->status, Order::PENDING);
    }

    public function testItBelongsToAUser()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(User::class, $order->user);
    }

    public function testItBelongsToAnAddress()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(Address::class, $order->address);
    }

    public function testItBelongsToAShippingMethod()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(ShippingMethod::class, $order->shippingMethod);
    }

    public function testItBelongsToAPaymentMethod()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(PaymentMethod::class, $order->paymentMethod);
    }

    public function testItHasManyProducts()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $order->products()->attach(
            factory(ProductVariation::class)->create(),
            [
                'quantity' => 1,
            ]
        );

        $this->assertInstanceOf(ProductVariation::class, $order->products->first());
    }

    public function testItHasAQuantityAttachedToTheProducts()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $order->products()->attach(
            factory(ProductVariation::class)->create(),
            [
                'quantity' => $quantity = 2,
            ]
        );

        $this->assertEquals($order->products->first()->pivot->quantity, $quantity);
    }

    public function testItReturnsAMoneyInstanceForTheSubtotal()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(Money::class, $order->subtotal);
    }

    public function testItReturnsAMoneyInstanceForTheTotal()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        $this->assertInstanceOf(Money::class, $order->total());
    }

    public function testItAddsShippingOntoTheTotal()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'subtotal' => 1000,
            'shipping_method_id' => factory(ShippingMethod::class)->create([
                'price' => 1000,
            ]),
        ]);

        $this->assertEquals($order->total()->amount(), 2000);
    }

    public function testItHasManyTransactions()
    {
        $order = factory(Order::class)->create([
            'user_id' => factory(User::class)->create()->id,
        ]);

        factory(Transaction::class)->create([
            'order_id' => $order->id,
        ]);

        $this->assertInstanceOf(Transaction::class, $order->transactions->first());
    }
}
