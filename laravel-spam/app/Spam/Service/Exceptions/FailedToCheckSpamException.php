<?php

namespace App\Spam\Service\Exceptions;

class FailedToCheckSpamException extends \Exception
{
    protected $message = 'Failed to check spam.';
}
