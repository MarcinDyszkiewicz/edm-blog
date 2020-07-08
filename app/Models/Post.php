<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public function getMainImageAttribute(): string
    {
        return $this->getFirstMediaUrl('main_image');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->using(CategoryPost::class)->withPivot('position')
            ->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function paragraphs(): HasMany
    {
        return $this->hasMany(Paragraph::class);
    }

    /**
     * @param int $categoryId
     * @return int|null
     */
    public function positionInCategory(int $categoryId): ?int
    {
        return $this->getCategory($categoryId)->pivot->position;
    }

    public function getCategory(int $categoryId): ?Category
    {
        return $this->categories()->where('category_id', $categoryId)->first();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')
            ->singleFile();
    }
}
