<?php

namespace Tests\Feature\Cart;

use App\Models\ProductVariation;
use App\Models\User;
use Tests\TestCase;

class CartDestroyTest extends TestCase
{
    public function testItFailsIfUnauthenticated()
    {
        $response = $this->json('DELETE', 'api/cart/1')
            ->assertStatus(401);
    }

    public function testItFailsIfProductCantBeFound()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'DELETE', 'api/cart/1')
            ->assertStatus(404);
    }

    public function testItDeletesAnItemFromTheCart()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $product = factory(ProductVariation::class)->create()
        );

        $response = $this->jsonAs($user, 'DELETE', "api/cart/{$product->id}");

        $this->assertDatabaseMissing('cart_user', [
            'product_variation_id' => $product->id,
        ]);
    }
}
