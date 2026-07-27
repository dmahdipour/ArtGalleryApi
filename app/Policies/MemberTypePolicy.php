<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MemberType;
use App\Models\User;

class MemberTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any MemberType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MemberType $membertype): bool
    {
        return $user->checkPermissionTo('view MemberType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create MemberType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MemberType $membertype): bool
    {
        return $user->checkPermissionTo('update MemberType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MemberType $membertype): bool
    {
        return $user->checkPermissionTo('delete MemberType');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any MemberType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MemberType $membertype): bool
    {
        return $user->checkPermissionTo('restore MemberType');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any MemberType');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, MemberType $membertype): bool
    {
        return $user->checkPermissionTo('replicate MemberType');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder MemberType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MemberType $membertype): bool
    {
        return $user->checkPermissionTo('force-delete MemberType');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any MemberType');
    }
}
