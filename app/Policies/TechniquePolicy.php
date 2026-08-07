<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Technique;
use App\Models\User;

class TechniquePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Technique');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Technique $technique): bool
    {
        return $user->checkPermissionTo('view Technique');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Technique');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Technique $technique): bool
    {
        return $user->checkPermissionTo('update Technique');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Technique $technique): bool
    {
        return $user->checkPermissionTo('delete Technique');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Technique');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Technique $technique): bool
    {
        return $user->checkPermissionTo('restore Technique');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Technique');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Technique $technique): bool
    {
        return $user->checkPermissionTo('replicate Technique');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Technique');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Technique $technique): bool
    {
        return $user->checkPermissionTo('force-delete Technique');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Technique');
    }
}
