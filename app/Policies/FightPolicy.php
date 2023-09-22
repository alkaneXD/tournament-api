<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Fight;
use Illuminate\Auth\Access\HandlesAuthorization;

class FightPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the fight can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list fights');
    }

    /**
     * Determine whether the fight can view the model.
     */
    public function view(User $user, Fight $model): bool
    {
        return $user->hasPermissionTo('view fights');
    }

    /**
     * Determine whether the fight can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create fights');
    }

    /**
     * Determine whether the fight can update the model.
     */
    public function update(User $user, Fight $model): bool
    {
        return $user->hasPermissionTo('update fights');
    }

    /**
     * Determine whether the fight can delete the model.
     */
    public function delete(User $user, Fight $model): bool
    {
        return $user->hasPermissionTo('delete fights');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete fights');
    }

    /**
     * Determine whether the fight can restore the model.
     */
    public function restore(User $user, Fight $model): bool
    {
        return false;
    }

    /**
     * Determine whether the fight can permanently delete the model.
     */
    public function forceDelete(User $user, Fight $model): bool
    {
        return false;
    }
}
