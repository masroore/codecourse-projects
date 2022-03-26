<?php

namespace Tests\Feature\Cart;

use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class CartUpdateTest extends TestCase
{
    public function testItFailsIfUnauthenticated()
    {
        $response = $this->json('PATCH', 'api/cart/1')
            ->assertStatus(401);
    }

    public function testItFailsIfProductCantBeFound()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'PATCH', 'api/cart/1')
            ->assertStatus(404);
    }

    public function testItRequriesAQuantity()
    {
        $user = factory(User::class)->create();

        $product = factory(ProductVariation::class)->create();

        $response = $this->jsonAs($user, 'PATCH', "api/cart/{$product->id}")
            ->assertJsonValidationErrors(['quantity']);
    }

    public function testItRequriesANumericQuantity()
    {
        $user = factory(User::class)->create();

        $product = factory(ProductVariation::class)->create();

        $response = $this->jsonAs($user, 'PATCH', "api/cart/{$product->id}", [
            'quantity' => 'one',
        ])
            ->assertJsonValidationErrors(['quantity']);
    }

    public function testItRequriesAQuantityOfOneOrMore()
    {
        $user = factory(User::class)->create();

        $product = factory(ProductVariation::class)->create();

        $response = $this->jsonAs($user, 'PATCH', "api/cart/{$product->id}", [
            'quantity' => 0,
        ])
            ->assertJsonValidationErrors(['quantity']);
    }

    public function testItUpdatesTheQuantityOfAProduct()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(),
            [
                'quantity' => 1,
            ]
        );

        $response = $this->jsonAs($user, 'PATCH', "api/cart/{$product->id}", [
            'quantity' => $quantity = 5,
        ]);

        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }
}
