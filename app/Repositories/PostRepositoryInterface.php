<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
    public function createPost(CreateUpdatePostRequest $request, User $user): Post;

    public function updatePost(CreateUpdatePostRequest $request, Post $post): Post;
}
