<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Http\Resources\MovieResource;
use App\Http\Responses\ExceptionResponse;
use App\Http\Responses\MyJsonResponse;
use App\Http\Responses\ValidationExceptionResponse;
use App\Models\Post;
use App\Models\User;
use App\Services\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
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
        } catch (\Exception $e) {
            return (new ExceptionResponse($e));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUpdatePostRequest $request
     * @param PostServiceInterface $postService
     * @return ExceptionResponse|MyJsonResponse|ValidationExceptionResponse
     */
    public function store(CreateUpdatePostRequest $request, PostServiceInterface $postService)
    {
        try {
            $user = User::all()->first() ?? factory(User::class);
            $movie = $postService->createPost($request->validated(), $user);

            return new MyJsonResponse($movie);
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
//        } catch (ValidationException $e) {
//            return new ValidationExceptionResponse($e);
        } catch (\Exception $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
