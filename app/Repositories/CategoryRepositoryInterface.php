<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function createCategory(CreateUpdateCategoryRequest $request): Category;

    public function updateCategory(CreateUpdateCategoryRequest $request, Category $category): Category;
}
