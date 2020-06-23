<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Models\Category;
use App\Models\Post;

interface CategoryRepositoryInterface
{
    public function createCategory(CreateUpdateCategoryRequest $request): Category;

    public function updateCategory(CreateUpdateCategoryRequest $request, Category $category): Category;

    public function attachPost(Category $category, Post $post, int $position = 0): void;

    public function lastCategoryPostInOrder(Category $category): ?object;
}
