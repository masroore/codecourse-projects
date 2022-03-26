<?php

namespace Tests\Feature\Cart;

use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class CartStoreTest extends TestCase
{
    public function testItFailsIfUnauthenticated()
    {
        $response = $this->json('POST', 'api/cart')
            ->assertStatus(401);
    }

    public function testItRequiresProducts()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart')
            ->assertJsonValidationErrors(['products']);
    }

    public function testItRequiresProductsToBeAnArray()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart', [
            'products' => 1,
        ])
            ->assertJsonValidationErrors(['products']);
    }

    public function testItRequiresProductsToHaveAnId()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart', [
            'products' => [
                ['quantity' => 1],
            ],
        ])
            ->assertJsonValidationErrors(['products.0.id']);
    }

    public function testItRequiresProductsToExist()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart', [
            'products' => [
                ['id' => 1, 'quantity' => 1],
            ],
        ])
            ->assertJsonValidationErrors(['products.0.id']);
    }

    public function testItRequiresProductsQuantityToBeNumeric()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart', [
            'products' => [
                ['id' => 1, 'quantity' => 'one'],
            ],
        ])
            ->assertJsonValidationErrors(['products.0.quantity']);
    }

    public function testItRequiresProductsQuantityToBeAtLeastOne()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart', [
            'products' => [
                ['id' => 1, 'quantity' => 0],
            ],
        ])
            ->assertJsonValidationErrors(['products.0.quantity']);
    }

    public function testItCanAddProductsToTheUsersCart()
    {
        $user = factory(User::class)->create();

        $product = factory(ProductVariation::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/cart', [
            'products' => [
                ['id' => $product->id, 'quantity' => 2],
            ],
        ]);

        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => 2,
        ]);
    }
}
