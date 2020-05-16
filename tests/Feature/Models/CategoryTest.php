<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private Category $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = factory(Category::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAttachesPostsWithProperPositions()
    {
        $postCount = 4;
        $user = factory(User::class)->create();
        $posts = factory(Post::class, $postCount)->create(['user_id' => $user->id]);

        foreach ($posts as $post) {
            $this->category->attachPost($post->id);
        }

        $this->assertEquals(
            range(0, $postCount -1),
            CategoryPost::positionsForCategory($this->category->id)->toArray()
        );
    }

    public function testAttachesPostsWithProperPositionWhenSpecified()
    {
        $user = factory(User::class)->create();
        $postOne = factory(Post::class)->create(['user_id' => $user->id]);
        $postOnePosition = 3;
        $postTwo = factory(Post::class)->create(['user_id' => $user->id]);
        $postTwoPosition = 5;

        $this->category->attachPost($postOne->id, $postOnePosition);
        $this->category->attachPost($postTwo->id, $postTwoPosition);

        $this->assertEquals($postOnePosition, $postOne->positionInCategory($this->category->id));
        $this->assertEquals($postTwoPosition, $postTwo->positionInCategory($this->category->id));
    }
}
