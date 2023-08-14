<?php

namespace App\Providers;

use App\Models\Fruit;
use App\Policies\FruitPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use App\Policies\UserAccessPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Fruit::class => FruitPolicy::class,
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        //project gates
        Gate::define('assign-project', [ProjectPolicy::class, 'assignProject']);
        Gate::define('check-project-access', function ($user, $id = null) {
            return (new UserAccessPolicy())->hasProjectAccess($user, $id);
        });

        //Task gates
        Gate::define('assign-task', [TaskPolicy::class, 'assignTask']);
        Gate::define('check-task-access', function ($user, $id = null) {
            return (new UserAccessPolicy())->hasTaskAccess($user, $id);
        });
    }
}
