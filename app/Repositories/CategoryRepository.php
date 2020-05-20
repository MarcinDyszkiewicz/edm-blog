<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Models\Category;
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
}
