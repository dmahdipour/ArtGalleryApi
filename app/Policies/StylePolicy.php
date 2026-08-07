<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Style;
use App\Models\User;

class StylePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Style');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Style $style): bool
    {
        return $user->checkPermissionTo('view Style');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Style');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Style $style): bool
    {
        return $user->checkPermissionTo('update Style');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Style $style): bool
    {
        return $user->checkPermissionTo('delete Style');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Style');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Style $style): bool
    {
        return $user->checkPermissionTo('restore Style');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Style');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Style $style): bool
    {
        return $user->checkPermissionTo('replicate Style');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Style');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Style $style): bool
    {
        return $user->checkPermissionTo('force-delete Style');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Style');
    }
}
