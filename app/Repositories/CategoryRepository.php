<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function createCategory(CreateUpdateCategoryRequest $request): Category
    {
        $category = new Category();
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->name = $request->name;
        $category->save();

        return $category;
    }

    public function updateCategory(CreateUpdateCategoryRequest $request, Category $category): Category
    {
        $category->slug = $request->slug ?? Str::slug($request->name);
        $category->name = $request->name;
        $category->save();

        return $category;
    }

    public function attachPost(Category $category, Post $post, int $position = 0): void
    {
        if (!$position) {
            $latUpdatedCategoryPost = $this->lastCategoryPostInOrder($category);

            if ($latUpdatedCategoryPost) {
                $position = $latUpdatedCategoryPost->position + 1;
            }
        }

        $category->posts()->attach($post->id, ['position' => $position]);
    }

    /**
     * @param Category $category
     * @return Model|HasMany|object|null
     */
    public function lastCategoryPostInOrder(Category $category): ?object
    {
        return $category->categoryPosts()->orderBy('position', 'desc')->first();
    }
}
