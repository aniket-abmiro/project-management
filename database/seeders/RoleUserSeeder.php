<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleUser = new RoleUser();
        $roleUser->role_id = 1;
        $roleUser->user_id = 1;
        $roleUser->save();
        RoleUser::factory(10)->create();
    }
}
