<?php

namespace App\Spam;

use App\Spam\Service\SpamServiceInterface;
use Illuminate\Support\Facades\Facade;

class Spam extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SpamServiceInterface::class;
    }
}
