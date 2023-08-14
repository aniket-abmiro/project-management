<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $permissionName = fake()->randomElement([
            'assign-project', 'assign-task', 'view-project', 'delete-project',
            'create-project', 'update-project', 'view-task', 'create-task', 'update-task', 'delete-task',
        ]);

        return [
            'name' => $permissionName,
        ];
    }
}
