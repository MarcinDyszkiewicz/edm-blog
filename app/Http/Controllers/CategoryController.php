<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateCategoryRequest;
use App\Http\Responses\ExceptionResponse;
use App\Http\Responses\MyJsonResponse;
use App\Models\Category;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @var CategoryServiceInterface
     */
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ExceptionResponse|MyJsonResponse
     */
    public function index()
    {
        try {
            $categories = Category::with('posts')->limit(20)->get();

            return new MyJsonResponse($categories);
        } catch (\Throwable $e) {
            return (new ExceptionResponse($e));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUpdateCategoryRequest $request
     * @return ExceptionResponse|MyJsonResponse
     */
    public function store(CreateUpdateCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->validated());

            return new MyJsonResponse($category, Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return ExceptionResponse|MyJsonResponse
     */
    public function show(Category $category)
    {
        try {
            return new MyJsonResponse($category->load('posts'));
        } catch (\Throwable $e) {
            return (new ExceptionResponse($e));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateUpdateCategoryRequest $request
     * @param Category $category
     * @return ExceptionResponse|MyJsonResponse
     */
    public function update(CreateUpdateCategoryRequest $request, Category $category)
    {
        try {
            $category = $this->categoryService->updateCategory($request->validated(), $category);

            return new MyJsonResponse($category, Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return ExceptionResponse|MyJsonResponse
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return new MyJsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }
}
