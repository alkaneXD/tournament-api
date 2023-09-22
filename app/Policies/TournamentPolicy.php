<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tournament;
use Illuminate\Auth\Access\HandlesAuthorization;

class TournamentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tournament can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list tournaments');
    }

    /**
     * Determine whether the tournament can view the model.
     */
    public function view(User $user, Tournament $model): bool
    {
        return $user->hasPermissionTo('view tournaments');
    }

    /**
     * Determine whether the tournament can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create tournaments');
    }

    /**
     * Determine whether the tournament can update the model.
     */
    public function update(User $user, Tournament $model): bool
    {
        return $user->hasPermissionTo('update tournaments');
    }

    /**
     * Determine whether the tournament can delete the model.
     */
    public function delete(User $user, Tournament $model): bool
    {
        return $user->hasPermissionTo('delete tournaments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete tournaments');
    }

    /**
     * Determine whether the tournament can restore the model.
     */
    public function restore(User $user, Tournament $model): bool
    {
        return false;
    }

    /**
     * Determine whether the tournament can permanently delete the model.
     */
    public function forceDelete(User $user, Tournament $model): bool
    {
        return false;
    }
}
