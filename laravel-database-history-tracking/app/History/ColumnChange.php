<?php

namespace App\History;

class ColumnChange
{
    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $column;

    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $from;

    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $to;

    /**
     * Undocumented function.
     *
     * @param [type] $column
     * @param [type] $from
     * @param [type] $to
     */
    public function __construct($column, $from, $to)
    {
        $this->column = $column;
        $this->from = $from;
        $this->to = $to;
    }
}
