<?php

namespace Database\Seeders;

use App\Models\SubTask;
use Illuminate\Database\Seeder;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubTask::factory(30)->create();
    }
}
