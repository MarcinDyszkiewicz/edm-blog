<?php

use App\Models\Category;
use App\Models\Paragraph;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    const USERS_AMOUNT = 2;
    const POSTS_AMOUNT = 10;
    const CATEGORIES_AMOUNT = 4;
    const PARAGRAPH_AMOUNT = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Users
        factory(User::class, self::USERS_AMOUNT)
            ->create()
            ->each(
                function (User $user) use (&$posts) {
                    $posts = $user->posts()->saveMany(factory(Post::class, self::POSTS_AMOUNT)->make());
                }
            );

        // Create Categories
        $categories = factory(Category::class, self::CATEGORIES_AMOUNT)->create();

        // Create Paragraphs
        foreach ($posts as $post) {
            $post->paragraphs()->saveMany(factory(Paragraph::class, self::PARAGRAPH_AMOUNT)->make());
        }

        // Attach posts to categories
        /** @var \Illuminate\Support\Collection $postGroups */
        $postGroups = $posts->split(self::CATEGORIES_AMOUNT);
        foreach ($categories as $key => $category) {
            foreach ($postGroups as $postGroup) {
                foreach ($postGroup as $postKey => $post) {
                    $category->posts()->attach($post->id, ['position' => $postKey]);
                }
            }
        }
    }
}
