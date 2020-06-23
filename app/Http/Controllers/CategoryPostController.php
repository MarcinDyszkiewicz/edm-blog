<?php

namespace App\Http\Controllers;

use App\Http\Responses\ExceptionResponse;
use App\Http\Responses\MyJsonResponse;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Category $category
     * @param Post $post
     * @return ExceptionResponse|MyJsonResponse
     */
    public function store(Category $category, Post $post)
    {
        try {
            $this->categoryRepository->attachPost($category, $post);

            return new MyJsonResponse($category->load('posts'));
        } catch (\Throwable $e) {
            return (new ExceptionResponse($e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
