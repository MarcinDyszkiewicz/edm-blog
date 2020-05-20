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
//            $posts = Post::query()->limit(20)->get();

            $test = $this->fetchItemsToDisplay([['p2',1,2],['p1',2,1]], 0, 0, 1, 0);

            dd($test);

            return new MyJsonResponse($posts);
        } catch (\Throwable $e) {
            return (new ExceptionResponse($e));
        }
    }

    function fetchItemsToDisplay($items, $sortParameter, $sortOrder, $itemsPerPage, $pageNumber) {

        usort($items, function($a, $b) use ($sortParameter) {
            // return strnatcmp($a[$sortParameter], $b[$sortParameter]);
            return $a[$sortParameter] <=> $b[$sortParameter];
        });

        if ($sortOrder == 1) {
            $items = array_reverse($items);
        }

        $items = array_chunk($items, $itemsPerPage);
        $page = $items[$pageNumber];


        return array_column($page, 0);
        // if($sortOrder == 0) {
        //     $sortedItems = asort($items);
        // }
        //     if($sortOrder == 1) {
        //     $sortedItems = arsort($items);
        // }

    }

    function numberOfTokens($expiryLimit, $commands) {

        $tokenId = $commands[0][1];
        $time = $commands[0][2];
        $expirity = $time + $expiryLimit;
        echo $commands[0][0]; die;

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
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return ExceptionResponse|MyJsonResponse
     */
    public function show(Post $post)
    {
        try {
            return new MyJsonResponse($post);
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
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
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
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
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }
}
