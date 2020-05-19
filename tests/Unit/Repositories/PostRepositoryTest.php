<?php

namespace Tests\Unit\Repositories;

use App\Http\Requests\CreateUpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PostRepositoryTest extends TestCase
{
    use InteractsWithContainer;

    private PostRepositoryInterface $postRepository;
    private User $user;
    private CreateUpdatePostRequest $request;
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepository = $this->createMock(PostRepositoryInterface::class);
        $this->post = $this->createMock(Post::class);
        $this->user = $this->createMock(User::class);
        $this->request = $this->createMock(CreateUpdatePostRequest::class);
    }

    public function testCreatePostProperly()
    {
        $this->postRepository
            ->method('createPost')
            ->with($this->request, $this->user)
            ->willReturn($this->post);

        $post = $this->postRepository->createPost($this->request, $this->user);

        $this->assertInstanceOf(Post::class, $post);
    }

    public function testUpdatePostProperly()
    {
        $this->postRepository
            ->method('updatePost')
            ->with($this->request, $this->post)
            ->willReturn($this->post);

        $post = $this->postRepository->updatePost($this->request, $this->post);

        $this->assertInstanceOf(Post::class, $post);
    }
}
