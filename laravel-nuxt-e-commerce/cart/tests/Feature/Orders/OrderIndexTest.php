<?php

namespace Tests\Feature\Orders;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class OrderIndexTest extends TestCase
{
    public function testItFailsIfUserIsntAuthenticated()
    {
        $this->json('GET', 'api/orders')
            ->assertStatus(401);
    }

    public function testItReturnsACollectionOfOrders()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id,
        ]);

        $this->jsonAs($user, 'GET', 'api/orders')
            ->assertJsonFragment([
                'id' => $order->id,
            ]);
    }

    public function testItOrdersByTheLatestFirst()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id,
        ]);

        $anotherOrder = factory(Order::class)->create([
            'user_id' => $user->id,
            'created_at' => now()->subDay(),
        ]);

        $this->jsonAs($user, 'GET', 'api/orders')
            ->assertSeeInOrder([
                $order->created_at->toDateTimeString(),
                $anotherOrder->created_at->toDateTimeString(),
            ]);
    }

    public function testItHasPagination()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/orders')
            ->assertJsonStructure([
                'links',
                'meta',
            ]);
    }
}
