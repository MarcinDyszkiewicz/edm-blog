<?php

/** @var Factory $factory */

use App\Models\Paragraph;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    Paragraph::class,
    function (Faker $faker) {
        return [
            'content' => $faker->paragraph,
            'post_id' => fn() => factory(Post::class)->create()->id,
        ];
    }
);
