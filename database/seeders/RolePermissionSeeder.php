<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newRolePermission = new RolePermission();
        $newRolePermission->role_id = 1;
        $newRolePermission->permission_id = 1;
        $newRolePermission->save();
        RolePermission::factory(10)->create();
    }
}
