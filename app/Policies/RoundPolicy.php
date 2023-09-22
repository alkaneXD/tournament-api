<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Round;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoundPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the round can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list rounds');
    }

    /**
     * Determine whether the round can view the model.
     */
    public function view(User $user, Round $model): bool
    {
        return $user->hasPermissionTo('view rounds');
    }

    /**
     * Determine whether the round can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create rounds');
    }

    /**
     * Determine whether the round can update the model.
     */
    public function update(User $user, Round $model): bool
    {
        return $user->hasPermissionTo('update rounds');
    }

    /**
     * Determine whether the round can delete the model.
     */
    public function delete(User $user, Round $model): bool
    {
        return $user->hasPermissionTo('delete rounds');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete rounds');
    }

    /**
     * Determine whether the round can restore the model.
     */
    public function restore(User $user, Round $model): bool
    {
        return false;
    }

    /**
     * Determine whether the round can permanently delete the model.
     */
    public function forceDelete(User $user, Round $model): bool
    {
        return false;
    }
}
