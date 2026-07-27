<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Reward;
use App\Models\User;

class RewardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Reward');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reward $reward): bool
    {
        return $user->checkPermissionTo('view Reward');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Reward');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reward $reward): bool
    {
        return $user->checkPermissionTo('update Reward');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reward $reward): bool
    {
        return $user->checkPermissionTo('delete Reward');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Reward');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reward $reward): bool
    {
        return $user->checkPermissionTo('restore Reward');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Reward');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Reward $reward): bool
    {
        return $user->checkPermissionTo('replicate Reward');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Reward');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reward $reward): bool
    {
        return $user->checkPermissionTo('force-delete Reward');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Reward');
    }
}
