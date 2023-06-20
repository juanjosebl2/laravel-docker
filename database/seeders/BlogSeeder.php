<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'title' => 'example blog admin',
            'description' => 'example description admin',
            'user_id' => 1,
        ]);

        Blog::create([
            'title' => 'example blog standard',
            'description' => 'example description standard',
            'user_id' => 2,
        ]);

        Blog::create([
            'title' => 'example blog admin 2',
            'description' => 'example description admin 2',
            'user_id' => 1,
        ]);
    }
}
