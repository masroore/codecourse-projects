<?php

namespace Tests\Unit\Money;

use App\Cart\Money;
use Money\Money as BaseMoney;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    public function testItCanGetTheRawAmount()
    {
        $money = new Money(1000);

        $this->assertEquals($money->amount(), 1000);
    }

    public function testItCanGetTheFormattedAmount()
    {
        $money = new Money(1000);

        $this->assertEquals($money->formatted(), '£10.00');
    }

    public function testItCanAddUp()
    {
        $money = new Money(1000);

        $money = $money->add(new Money(1000));

        $this->assertEquals($money->amount(), 2000);
    }

    public function testItCanReturnTheUnderlyingInstance()
    {
        $money = new Money(1000);

        $this->assertInstanceOf(BaseMoney::class, $money->instance());
    }
}
