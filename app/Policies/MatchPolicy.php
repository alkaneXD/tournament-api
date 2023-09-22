<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Match;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the match can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list matches');
    }

    /**
     * Determine whether the match can view the model.
     */
    public function view(User $user, Match $model): bool
    {
        return $user->hasPermissionTo('view matches');
    }

    /**
     * Determine whether the match can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create matches');
    }

    /**
     * Determine whether the match can update the model.
     */
    public function update(User $user, Match $model): bool
    {
        return $user->hasPermissionTo('update matches');
    }

    /**
     * Determine whether the match can delete the model.
     */
    public function delete(User $user, Match $model): bool
    {
        return $user->hasPermissionTo('delete matches');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete matches');
    }

    /**
     * Determine whether the match can restore the model.
     */
    public function restore(User $user, Match $model): bool
    {
        return false;
    }

    /**
     * Determine whether the match can permanently delete the model.
     */
    public function forceDelete(User $user, Match $model): bool
    {
        return false;
    }
}
