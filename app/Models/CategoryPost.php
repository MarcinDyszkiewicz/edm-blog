<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;

class CategoryPost extends Pivot
{
    public static function positionsForCategory(int $categoryId): Collection
    {
        return CategoryPost::query()->where('category_id', $categoryId)->pluck('position');
    }
}
