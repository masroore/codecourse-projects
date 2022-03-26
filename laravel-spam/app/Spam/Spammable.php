<?php

namespace App\Spam;

use App\Spam\Exceptions\NullColumnException;
use Spam;

trait Spammable
{
    public function getSpamColumns()
    {
        return [];
    }

    public function isSpam(array $additional = [])
    {
        return Spam::isSpam($this->getSpamColumnValues(), $additional);
    }

    public function markAsSpam(array $additional = [])
    {
        return Spam::markAsSpam($this->getSpamColumnValues(), $additional);
    }

    public function markAsHam(array $additional = [])
    {
        return Spam::markAsHam($this->getSpamColumnValues(), $additional);
    }

    protected function getSpamColumnValues()
    {
        $modelArray = $this->toArray();

        if (\count($this->getSpamColumns()) < 1) {
            throw new NullColumnException();
        }

        return array_filter(array_map(function ($column) use ($modelArray) {
            return array_get($modelArray, $column);
        }, $this->getSpamColumns()));
    }
}
