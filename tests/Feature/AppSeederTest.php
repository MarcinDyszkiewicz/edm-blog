<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Paragraph;
use App\Models\Post;
use App\Models\User;
use AppSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppSeederTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(AppSeeder::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreatesUsersProperly()
    {
        $this->assertEquals(AppSeeder::USERS_COUNT, User::all()->count());
    }

    public function testCreatesPostsProperly()
    {
        $postCountExpected = AppSeeder::POSTS_PER_USER_COUNT * AppSeeder::USERS_COUNT;

        $this->assertEquals($postCountExpected, Post::all()->count());
    }

    public function testCreatesCategoriesProperly()
    {
        $this->assertEquals(AppSeeder::CATEGORIES_COUNT, Category::all()->count());
    }

    public function testCreatesParagraphsProperly()
    {
        $postCountExpected = AppSeeder::POSTS_PER_USER_COUNT * AppSeeder::USERS_COUNT;

        $this->assertEquals(AppSeeder::PARAGRAPH_PER_POST_COUNT * $postCountExpected, Paragraph::all()->count());
    }

    public function testAttachesPostsToCategoryProperly()
    {
        $postCountExpected = AppSeeder::POSTS_PER_USER_COUNT * AppSeeder::USERS_COUNT;

        $randomCategory = Category::all()->random();

        $this->assertEquals($postCountExpected / AppSeeder::CATEGORIES_COUNT, $randomCategory->posts()->count());
    }

    public function testProductsHaveProperPositionsInCategory()
    {
        $randomCategory = Category::all()->random();

        $this->assertEquals(
            range(0, AppSeeder::CATEGORIES_COUNT),
            CategoryPost::positionsForCategory($randomCategory->id)->toArray()
        );
    }
}
