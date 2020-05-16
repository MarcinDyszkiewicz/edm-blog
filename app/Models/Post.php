<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->using(CategoryPost::class)->withPivot('position')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paragraphs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Paragraph::class);
    }

    /**
     * @param int $categoryId
     * @return int|null
     */
    public function positionInCategory(int $categoryId)
    {
        return $this->getCategory($categoryId)->pivot->position;
    }

    public function getCategory(int $categoryId): ?Category
    {
        return $this->categories()->where('category_id', $categoryId)->first();
    }
}
