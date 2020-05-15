<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(Category::class);
        // $this->call(Post::class);
        // $this->call(UserSeeder::class);
    }
}
