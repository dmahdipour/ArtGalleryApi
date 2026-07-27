<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MediaType;
use App\Models\User;

class MediaTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any MediaType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MediaType $mediatype): bool
    {
        return $user->checkPermissionTo('view MediaType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create MediaType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MediaType $mediatype): bool
    {
        return $user->checkPermissionTo('update MediaType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MediaType $mediatype): bool
    {
        return $user->checkPermissionTo('delete MediaType');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any MediaType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MediaType $mediatype): bool
    {
        return $user->checkPermissionTo('restore MediaType');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any MediaType');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, MediaType $mediatype): bool
    {
        return $user->checkPermissionTo('replicate MediaType');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder MediaType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MediaType $mediatype): bool
    {
        return $user->checkPermissionTo('force-delete MediaType');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any MediaType');
    }
}
