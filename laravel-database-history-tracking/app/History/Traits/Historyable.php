<?php

namespace App\History\Traits;

use App\History;
use App\History\ColumnChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait Historyable
{
    /**
     * Undocumented function.
     *
     * @return void
     */
    public static function bootHistoryable()
    {
        static::updated(function (Model $model) {
            collect($model->getWantedChangedColumns($model))->each(function ($change) use ($model) {
                $model->saveChange($change);
            });
        });
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function history()
    {
        return $this->morphMany(History::class, 'historyable')
            ->oldest();
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function ignoreHistoryColumns()
    {
        return [
            'updated_at',
        ];
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    protected function saveChange(ColumnChange $change)
    {
        $this->history()->create([
            'changed_column' => $change->column,
            'changed_value_from' => $change->from,
            'changed_value_to' => $change->to,
        ]);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    protected function getWantedChangedColumns(Model $model)
    {
        return collect(
            array_diff(
                Arr::except($model->getChanges(), $this->ignoreHistoryColumns()),
                $original = $model->getOriginal()
            )
        )
            ->map(function ($change, $column) use ($original) {
                return new ColumnChange($column, Arr::get($original, $column), $change);
            });
    }
}
