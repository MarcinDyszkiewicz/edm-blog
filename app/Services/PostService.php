<?php

namespace App\Services;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Request;

class PostService implements PostServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost(CreateUpdatePostRequest $request, User $user): Post
    {
        $this->postRepository->createPost($request, $user);
    }

    public function updatePost(CreateUpdatePostRequest $request, Post $post): Post
    {
        $this->postRepository->updatePost($request, $post);
    }
}
