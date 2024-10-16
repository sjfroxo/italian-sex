<?php

namespace App\Models;

use App\Filters\Filter;
use App\Models\Traits\HasFilter;
use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method filter(Builder $builder, Filter $filter)
 */
class Category extends Model
{
    use HasFilter;
    use HasSlug;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
