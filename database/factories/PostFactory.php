<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Paragraph;
use App\Models\Post;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(
    Post::class,
    function (Faker $faker) {
        return [
            'slug' => $faker->slug,
            'user_id' => factory(User::class),
            'title' => $faker->word,
            'published_at' => $faker->dateTimeThisMonth(),
        ];
    }
);

$factory->afterCreatingState(Post::class, 'withParagraphs', function (Post $post) {
    $post->paragraphs()->saveMany(factory(Paragraph::class, 3)->make());
});
