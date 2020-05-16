<?php

use App\Models\Category;
use App\Models\Paragraph;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    const USERS_COUNT = 2;
    const POSTS_PER_USER_COUNT = 10;
    const CATEGORIES_COUNT = 4;
    const PARAGRAPH_PER_POST_COUNT = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Users
        factory(User::class, self::USERS_COUNT)
            ->create()
            ->each(
                function (User $user) {
                    $user
                        ->posts()
                        ->saveMany(
                            factory(Post::class, self::POSTS_PER_USER_COUNT)
                                ->make(['user_id' => null])
                        );
                }
            );

        // Create Categories
        $categories = factory(Category::class, self::CATEGORIES_COUNT)->create();

        $posts = Post::all();

        // Create Paragraphs
        foreach ($posts as $post) {
            $post
                ->paragraphs()
                ->saveMany(
                    factory(Paragraph::class, self::PARAGRAPH_PER_POST_COUNT)
                        ->make(['post_id' => null])
                );
        }

        // Attach posts to categories
        /** @var \Illuminate\Support\Collection $postGroups */
        $postGroups = $posts->split(self::CATEGORIES_COUNT);
        foreach ($categories as $key => $category) {
            foreach ($postGroups as $postGroup) {
                foreach ($postGroup as $postKey => $post) {
                    $category->attachPost($post->id, $postKey);
                }
                break;
            }
        }
    }
}
