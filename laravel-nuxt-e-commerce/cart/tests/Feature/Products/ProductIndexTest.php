<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    public function testItShowsACollectionOfProducts()
    {
        $product = factory(Product::class)->create();

        $this->json('GET', 'api/products')
            ->assertJsonFragment([
                'id' => $product->id,
            ]);
    }

    public function testItHasPaginatedData()
    {
        $this->json('GET', 'api/products')
            ->assertJsonStructure([
                'meta',
            ]);
    }
}
