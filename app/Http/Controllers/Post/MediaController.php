<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\SinglePostResource;
use App\Http\Responses\ExceptionResponse;
use App\Models\Post;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Post $post
     * @param \Illuminate\Http\Request $request
     * @return ExceptionResponse|SinglePostResource
     */
    public function store(Post $post, Request $request)
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $post->addMediaFromRequest('image')->toMediaCollection('main_image');
            }
            return SinglePostResource::make($post->load('paragraphs'));
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
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
