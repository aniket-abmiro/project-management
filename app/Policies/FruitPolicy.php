<?php

namespace App\Policies;

use App\Models\Fruit;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FruitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        Log::debug('FruitPolicy::viewAny');

        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fruit $fruit): bool
    {
        Log::debug('FruitPolicy::view');

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //

        $roleNames = $user->roles()->pluck('name')->toArray();
        if (in_array('Senior', $roleNames)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fruit $fruit): bool
    {
        //

        $roleNames = $user->roles()->pluck('name')->toArray();
        if (in_array('Lead', $roleNames)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fruit $fruit): bool
    {
        //

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fruit $fruit): bool
    {
        //

        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fruit $fruit): bool
    {
        //

        return true;
    }
}
