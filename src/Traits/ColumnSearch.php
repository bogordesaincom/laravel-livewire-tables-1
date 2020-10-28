<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait ColumnSearch.
 */
trait ColumnSearch
{
    /**
     * Filters
     *
     * @var array
     */
    public $filters = [];

    /**
     * Filter value
     *
     * @var array
     */
    public $filterValues = [];

    /**
     * Resolve fields
     */
    private function modelsWithFilters(): object
    {
        $model = $this->models();

        foreach($this->filters as $row) {
            list($filter, $field, $tableRow) = array_values($row);
            $value = $this->filterValues[$filter] ?? null;

            if($value) {
                $model = ($filter === 'date')
                    ? $this->filterByDate($value, $field, $model)
                    : $model->where($field, $value);
            }
        }

        return $model;
    }

    /**
     * Resolve data filter
     */
    private function filterByDate($value, $field, $model): object
    {
        if(isset($value['start'])) {
            $model = $model->whereDate($field, '>=', $value['start']);
        }

        if(isset($value['end'])) {
            $model = $model->whereDate($field, '<=', $value['end']);
        }

        return $model;
    }
}
