<?php

namespace App\Spam\Service\Exceptions;

class FailedToMarkAsHamException extends \Exception
{
    protected $message = 'Failed to mark as ham.';
}
