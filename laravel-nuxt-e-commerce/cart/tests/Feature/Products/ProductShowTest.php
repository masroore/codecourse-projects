<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    public function testItFailsIfAProductCantBeFound()
    {
        $this->json('GET', 'api/products/nope')
            ->assertStatus(404);
    }

    public function testItShowsAProduct()
    {
        $product = factory(Product::class)->create();

        $this->json('GET', "api/products/{$product->slug}")
            ->assertJsonFragment([
                'id' => $product->id,
            ]);
    }
}
