<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Http\Resources\SinglePostResource;
use App\Http\Responses\ExceptionResponse;
use App\Http\Responses\MyJsonResponse;
use App\Http\Responses\ValidationExceptionResponse;
use App\Models\Post;
use App\Models\User;
use App\Services\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PostController extends Controller
{
    /**
     * @var PostServiceInterface
     */
    private PostServiceInterface $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ExceptionResponse|MyJsonResponse
     */
    public function index()
    {
        try {
            $posts = Post::query()->limit(20)->get();

            return new MyJsonResponse($posts);
        } catch (\Throwable $e) {
            return (new ExceptionResponse($e));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUpdatePostRequest $request
     * @return ExceptionResponse|MyJsonResponse|ValidationExceptionResponse
     */
    public function store(CreateUpdatePostRequest $request)
    {
        try {
            $user = User::all()->first() ?? factory(User::class)->create();
            $post = $this->postService->createPost($request->validated(), $user);

            return new MyJsonResponse($post, Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return SinglePostResource|ExceptionResponse
     */
    public function show(Post $post)
    {
        try {
            return SinglePostResource::make($post->load('paragraphs'));
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateUpdatePostRequest $request
     * @param Post $post
     * @return ExceptionResponse|MyJsonResponse
     */
    public function update(CreateUpdatePostRequest $request, Post $post)
    {
        try {
            $post = $this->postService->updatePost($request->validated(), $post);

            return new MyJsonResponse($post, Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return ExceptionResponse|MyJsonResponse
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return new MyJsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }
}
