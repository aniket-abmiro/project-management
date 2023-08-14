<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = new Role();
        $role->name = 'admin';
        $role->save();
        Role::factory(10)->create();
    }
}
