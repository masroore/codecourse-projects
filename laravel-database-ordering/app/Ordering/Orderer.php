<?php

namespace App\Ordering;

use Illuminate\Database\Eloquent\Model;

class Orderer
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function first()
    {
        return $this->model->query()->orderBy('order', 'asc')
            ->first()
            ->order - 1;
    }

    public function last()
    {
        return $this->model->query()->orderBy('order', 'desc')
            ->first()
            ->order + 1;
    }

    public function after()
    {
        $adjacent = $this->model->query()->where('order', '>', $this->model->order)
            ->orderBy('order', 'asc')
            ->first();

        if (!$adjacent) {
            return $this->last();
        }

        return ($this->model->order + $adjacent->order) / 2;
    }

    public function before()
    {
        $adjacent = $this->model->query()->where('order', '<', $this->model->order)
            ->orderBy('order', 'desc')
            ->first();

        if (!$adjacent) {
            return $this->first();
        }

        return ($this->model->order + $adjacent->order) / 2;
    }
}
