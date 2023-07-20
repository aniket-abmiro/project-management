<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Policies\ProjectPolicy;
use App\Policies\UserAccessPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('assign-project', [ProjectPolicy::class, 'assignProject']);
        Gate::define('view-project', [ProjectPolicy::class, 'viewProject']);
        Gate::define('create-project', [ProjectPolicy::class, 'createProject']);
        Gate::define('update-project', [ProjectPolicy::class, 'updateProject']);
        Gate::define('delete-project', [ProjectPolicy::class, 'deleteProject']);



        Gate::define('check-project-access', function ($user, $id = null) {
            return (new UserAccessPolicy())->hasProjectAccess($user, $id);
        });
    }
}
