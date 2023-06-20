<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'text' => 'example task',
            'difficulty' => 'medium',
            'user_id' => 1,
        ]);
        Task::factory(2)->create();
    }
}
