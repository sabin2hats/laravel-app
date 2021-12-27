<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
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

        $user = User::factory()->create();
        $category = Category::factory()->create();
        Blog::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $category->id
        ]);
    }
}
