<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\link_position;
use App\Models\User;

class link_positionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any link_position');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, link_position $link_position): bool
    {
        return $user->checkPermissionTo('view link_position');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create link_position');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, link_position $link_position): bool
    {
        return $user->checkPermissionTo('update link_position');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, link_position $link_position): bool
    {
        return $user->checkPermissionTo('delete link_position');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any link_position');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, link_position $link_position): bool
    {
        return $user->checkPermissionTo('restore link_position');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any link_position');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, link_position $link_position): bool
    {
        return $user->checkPermissionTo('replicate link_position');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder link_position');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, link_position $link_position): bool
    {
        return $user->checkPermissionTo('force-delete link_position');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any link_position');
    }
}
