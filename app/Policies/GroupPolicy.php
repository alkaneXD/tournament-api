<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the group can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list groups');
    }

    /**
     * Determine whether the group can view the model.
     */
    public function view(User $user, Group $model): bool
    {
        return $user->hasPermissionTo('view groups');
    }

    /**
     * Determine whether the group can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create groups');
    }

    /**
     * Determine whether the group can update the model.
     */
    public function update(User $user, Group $model): bool
    {
        return $user->hasPermissionTo('update groups');
    }

    /**
     * Determine whether the group can delete the model.
     */
    public function delete(User $user, Group $model): bool
    {
        return $user->hasPermissionTo('delete groups');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete groups');
    }

    /**
     * Determine whether the group can restore the model.
     */
    public function restore(User $user, Group $model): bool
    {
        return false;
    }

    /**
     * Determine whether the group can permanently delete the model.
     */
    public function forceDelete(User $user, Group $model): bool
    {
        return false;
    }
}
