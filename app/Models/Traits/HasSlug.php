<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        $id = explode('=', $value);
        return $query->where($field ?? $this->getRouteKeyName(), $id);
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->id . ' ' . $this->title);
    }
}
