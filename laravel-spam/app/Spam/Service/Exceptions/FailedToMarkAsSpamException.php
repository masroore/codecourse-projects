<?php

namespace App\Spam\Service\Exceptions;

class FailedToMarkAsSpamException extends \Exception
{
    protected $message = 'Failed to mark as spam.';
}
