<?php

namespace Tests\Unit\Listeners;

use App\Cart\Payments\Gateways\StripeGateway;
use App\Cart\Payments\Gateways\StripeGatewayCustomer;
use App\Events\Order\OrderCreated;
use App\Events\Order\OrderPaid;
use App\Events\Order\OrderPaymentFailed;
use App\Exceptions\PaymentFailedException;
use App\Listeners\Order\ProcessPayment;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class ProcessPaymentListenerTest extends TestCase
{
    public function testItChargesTheChosenPaymentTheCorrectAmount()
    {
        Event::fake();

        [$user, $payment, $order, $event] = $this->createEvent();
        [$gateway, $customer] = $this->mockFlow();

        $customer->shouldReceive('charge')->with(
            $order->paymentMethod,
            $order->total()->amount()
        );

        $listener = new ProcessPayment($gateway);

        $listener->handle($event);
    }

    public function testItFiresTheOrderPaidEvent()
    {
        Event::fake();

        [$user, $payment, $order, $event] = $this->createEvent();
        [$gateway, $customer] = $this->mockFlow();

        $customer->shouldReceive('charge')->with(
            $order->paymentMethod,
            $order->total()->amount()
        );

        $listener = new ProcessPayment($gateway);

        $listener->handle($event);

        Event::assertDispatched(OrderPaid::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }

    public function testItFiresTheOrderFailedEvent()
    {
        Event::fake();

        [$user, $payment, $order, $event] = $this->createEvent();
        [$gateway, $customer] = $this->mockFlow();

        $customer->shouldReceive('charge')->with(
            $order->paymentMethod,
            $order->total()->amount()
        )
            ->andThrow(PaymentFailedException::class);

        $listener = new ProcessPayment($gateway);

        $listener->handle($event);

        Event::assertDispatched(OrderPaymentFailed::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }

    protected function createEvent()
    {
        $user = factory(User::class)->create();

        $payment = factory(PaymentMethod::class)->create([
            'user_id' => $user->id,
        ]);

        $event = new OrderCreated(
            $order = factory(Order::class)->create([
                'user_id' => $user->id,
                'payment_method_id' => $payment->id,
            ])
        );

        return [$user, $payment, $order, $event];
    }

    protected function mockFlow()
    {
        $gateway = Mockery::mock(StripeGateway::class);

        $gateway->shouldReceive('withUser')
            ->andReturn($gateway)
            ->shouldReceive('getCustomer')
            ->andReturn(
                $customer = Mockery::mock(StripeGatewayCustomer::class)
            );

        return [$gateway, $customer];
    }
}
