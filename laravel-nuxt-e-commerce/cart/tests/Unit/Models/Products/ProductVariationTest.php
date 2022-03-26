<?php

namespace Tests\Unit\Models\Products;

use App\Cart\Money;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Models\Stock;
use Tests\TestCase;

class ProductVariationTest extends TestCase
{
    public function testItHasOneVariationType()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    public function testItBelongsToAProduct()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }

    public function testItReturnsAMoneyInstanceForThePrice()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Money::class, $variation->price);
    }

    public function testItReturnsAFormattedPrice()
    {
        $variation = factory(ProductVariation::class)->create([
            'price' => 1000,
        ]);

        $this->assertEquals($variation->formattedPrice, '£10.00');
    }

    public function testItReturnsTheProductPriceIfPriceIsNull()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => null,
            'product_id' => $product->id,
        ]);

        $this->assertEquals($product->price->amount(), $variation->price->amount());
    }

    public function testItCanCheckIfTheVariationPriceIsDifferentToTheProduct()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => 2000,
            'product_id' => $product->id,
        ]);

        $this->assertTrue($variation->priceVaries());
    }

    public function testItHasManyStocks()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(Stock::class, $variation->stocks->first());
    }

    public function testItHasStockInformation()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(ProductVariation::class, $variation->stock->first());
    }

    public function testItHasStockCountPivotWithinStockInformation()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantiy = 5,
            ])
        );

        $this->assertEquals($variation->stock->first()->pivot->stock, $quantiy);
    }

    public function testItHasInStockPivotWithinStockInformation()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($variation->stock->first()->pivot->in_stock);
    }

    public function testItCanCheckIfItsInStock()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($variation->inStock());
    }

    public function testItCanGetStockCount()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5,
            ])
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5,
            ])
        );

        $this->assertEquals($variation->stockCount(), 10);
    }

    public function testItCanGetTheMinimumStockForAGivenValue()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5,
            ])
        );

        $this->assertEquals($variation->minStock(200), $quantity);
    }
}
