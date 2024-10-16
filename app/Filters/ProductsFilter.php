<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductFilter
 */
class ProductsFilter extends Filter
{
    protected function category(string $value): Builder
    {
        return $this->builder->where('slug', $value);
    }

    protected function categoryId(mixed $value): Builder
    {
        return $this->builder->where('category_id', $value);
    }
}
