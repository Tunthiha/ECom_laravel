<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
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
        User::factory()->create();
        Color::factory()->count(5)->create();
        Size::factory()->count(5)->create();
        Category::factory()->count(5)->create();
    }
}
