<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFilter;
    use HasSlug;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'path',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
