<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            TaskSeeder::class,
            SubTaskSeeder::class,
            ProjectUserSeeder::class,
            TaskUserSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,
            RolePermissionSeeder::class,
            PermissionSeeder::class,

        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
