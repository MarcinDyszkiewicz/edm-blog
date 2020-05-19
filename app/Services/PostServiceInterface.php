<?php

namespace App\Services;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Post;
use App\Models\User;

interface PostServiceInterface
{
    public function createPost(CreateUpdatePostRequest $request, User $user): Post;

    public function updatePost(CreateUpdatePostRequest $request, Post $post): Post;
}
