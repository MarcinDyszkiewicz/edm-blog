<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    public function createPost(CreateUpdatePostRequest $request, User $user): Post
    {
        $post = new Post();
        $post->slug = $request->slug ?? Str::slug($request->title);
        $post->user_id = $user->id;
        $post->title = $request->title;
        $post->published_at = $request->published_at;
        $post->save();

        return $post;
    }

    public function updatePost(CreateUpdatePostRequest $request, Post $post): Post
    {
        $post->slug = $request->slug ?? Str::slug($request->title);
        $post->title = $request->title;
        $post->published_at = $request->published_at;
        $post->save();

        return $post;
    }

}
