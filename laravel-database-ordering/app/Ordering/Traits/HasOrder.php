<?php

namespace App\Ordering\Traits;

use App\Ordering\Orderer;

trait HasOrder
{
    public function ordering()
    {
        return new Orderer($this);
    }
}
