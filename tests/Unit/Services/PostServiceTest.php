<?php

namespace Tests\Unit\Services;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\PostServiceInterface;
use PHPUnit\Framework\TestCase;

class PostServiceTest extends TestCase
{
    private PostServiceInterface $postService;
    private User $user;
    private CreateUpdatePostRequest $request;
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postService = $this->createMock(PostServiceInterface::class);
        $this->post = $this->createMock(Post::class);
        $this->user = $this->createMock(User::class);
        $this->request = $this->createMock(CreateUpdatePostRequest::class);
    }

    public function testCreatePostProperly()
    {
        $this->postService
            ->method('createPost')
            ->with($this->request, $this->user)
            ->willReturn($this->post);

        $post = $this->postService->createPost($this->request, $this->user);

        $this->assertInstanceOf(Post::class, $post);
    }

    public function testUpdatePostProperly()
    {
        $this->postService
            ->method('updatePost')
            ->with($this->request, $this->post)
            ->willReturn($this->post);

        $post = $this->postService->updatePost($this->request, $this->post);

        $this->assertInstanceOf(Post::class, $post);
    }
}
