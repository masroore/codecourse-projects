<?php

namespace App\Spam\Exceptions;

class NullColumnException extends \Exception
{
    protected $message = 'You must define at least one column to check.';
}
