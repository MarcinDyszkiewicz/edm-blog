<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
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
        $requestParams = [
            'name' => 'Category name',
            'slug' => '',
        ];

        $response = $this->postJson(route('category.store'), $requestParams);

        $this->assertDatabaseHas('categories', ['name' => 'Category name']);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'data' => [
                        'name' => 'Category name',
                        'slug' => 'category-name',
                    ]
                ]
            );
    }

    public function testUpdateAction()
    {
        $category = factory(Category::class)->create(
            [
                'name' => 'Category name',
                'slug' => 'category-name',
            ]
        );
        $requestParams = [
            'name' => 'New Category name',
            'slug' => 'new-category-name-slug',
        ];

        $response = $this->putJson(route('category.update', ['category' => $category]), $requestParams);

        $this->assertDatabaseHas('categories', $requestParams);
        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'data' => $requestParams
                ]
            );
    }

    public function testDestroyAction()
    {
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('category.destroy', ['category' => $category]));

        $this->assertSoftDeleted($category);
        $response
            ->assertStatus(204);
    }
}
