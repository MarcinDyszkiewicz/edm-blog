<?php

namespace Tests\Feature\Controllers;

use App\Models\Paragraph;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParagraphControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexAction()
    {
        $post = factory(Post::class)->create();
        factory(Paragraph::class, 2)->create(
            [
                'post_id' => $post->id,
                'content' => 'paragraph content',
            ]
        );

        $response = $this->getJson(route('post.paragraph.index', ['post' => $post->id]));

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'data' => [
                        0 => ['content' => 'paragraph content'],
                        1 => ['content' => 'paragraph content'],
                    ]
                ]
            );
    }

    public function testStoreAction()
    {
        $post = factory(Post::class)->create();
        $paragraphRequestParams = ['content' => 'paragraph content'];

        $response = $this->postJson(route('post.paragraph.store', ['post' => $post->id]), $paragraphRequestParams);

        $this->assertDatabaseHas('paragraphs', ['content' => 'paragraph content']);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'content' => 'paragraph content',
                    ]
                ]
            );
    }

    public function testUpdateAction()
    {
        $post = factory(Post::class)->create();
        $paragraph = factory(Paragraph::class)->create(
            [
                'post_id' => $post->id,
                'content' => 'paragraph content',
            ]
        );
        $paragraphRequestParams = ['content' => 'new paragraph content'];

        $response = $this->putJson(
            route('post.paragraph.update', ['post' => $post, 'paragraph' => $paragraph]),
            $paragraphRequestParams
        );

        $this->assertDatabaseHas('paragraphs', $paragraphRequestParams);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'content' => 'new paragraph content',
                    ]
                ]
            );
    }

    public function testDestroyAction()
    {
        $post = factory(Post::class)->create();
        $paragraph = factory(Paragraph::class)->create(['post_id' => $post->id]);

        $response = $this->deleteJson(route('post.paragraph.destroy', ['post' => $post, 'paragraph' => $paragraph]));

        $this->assertSoftDeleted($paragraph);
        $response->assertStatus(204);
    }
}
