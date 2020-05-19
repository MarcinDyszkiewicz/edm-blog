<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexAction()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testStoreAction()
    {
        $postRequestParams = [
            'title' => 'Post Title',
            'slug' => '',
            'published_at' => '',
        ];

        $response = $this->postJson(route('post.store'), $postRequestParams);

        $this->assertDatabaseHas('posts', ['title' => 'Post Title']);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'title' => 'Post Title',
                        'slug' => 'post-title',
                        'published_at' => null,
                    ]
                ]
            );
    }

    public function testUpdateAction()
    {
        $post = factory(Post::class)->create(
            [
                'title' => 'Post Title',
                'slug' => 'post-title',
                'published_at' => null
            ]
        );
        $now = now()->toString();
        $postRequestParams = [
            'title' => 'New Post Title',
            'slug' => 'new-post-title-slug',
            'published_at' => $now,
        ];

        $response = $this->putJson(route('post.update', ['post' => $post]), $postRequestParams);

        $this->assertDatabaseHas('posts', $postRequestParams);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'title' => 'New Post Title',
                        'slug' => 'new-post-title-slug',
                        'published_at' => $now,
                    ]
                ]
            );
    }

    public function testDestroyAction()
    {
        $post = factory(Post::class)->create();

        $response = $this->deleteJson(route('post.update', ['post' => $post]));

        $this->assertSoftDeleted($post);
        $response
            ->assertStatus(204);
    }
}
