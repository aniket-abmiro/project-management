<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newPermission = new Permission();
        $newPermission->name = 'assign-role';
        $newPermission->save();

        Permission::factory(10)->create();
    }
}
