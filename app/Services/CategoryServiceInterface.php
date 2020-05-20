<?php

namespace App\Services;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Models\Category;

interface CategoryServiceInterface
{
    public function createCategory(CreateUpdateCategoryRequest $request): Category;

    public function updateCategory(CreateUpdateCategoryRequest $request, Category $category): Category;
}
