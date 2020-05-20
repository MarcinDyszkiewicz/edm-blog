<?php

namespace App\Services;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(CreateUpdateCategoryRequest $request): Category
    {
        return $this->categoryRepository->createCategory($request);
    }

    public function updateCategory(CreateUpdateCategoryRequest $request, Category $category): Category
    {
        return $this->categoryRepository->updateCategory($request, $category);
    }
}
