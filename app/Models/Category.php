<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)->using(CategoryPost::class)->withPivot('position')
            ->withTimestamps();
    }

    public function categoryPosts(): HasMany
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function attachPost(int $postId, int $position = 0): void
    {
        if (!$position) {
            $latUpdatedCategoryPost = $this->lastCategoryPostInOrder();

            if ($latUpdatedCategoryPost) {
                $position = $latUpdatedCategoryPost->position + 1;
            }
        }

        $this->posts()->attach($postId, ['position' => $position]);
    }

    public function latestPost(): ?Post
    {
        return $this->posts()->latest()->first();
    }

    /**
     * @return Model|HasMany|object|null
     */
    public function lastCategoryPostInOrder(): ?object
    {
        return $this->categoryPosts()->orderBy('position', 'desc')->first();
    }
}
