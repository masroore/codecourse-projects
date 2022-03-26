<?php

namespace App\Spam\Service\Exceptions;

class InvalidApiKeyException extends \Exception
{
    protected $message = 'Your service API key is invalid.';
}
