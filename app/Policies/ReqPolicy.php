<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Req;
use App\Models\User;

class ReqPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Req');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Req $req): bool
    {
        return $user->checkPermissionTo('view Req');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Req');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Req $req): bool
    {
        return $user->checkPermissionTo('update Req');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Req $req): bool
    {
        return $user->checkPermissionTo('delete Req');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Req');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Req $req): bool
    {
        return $user->checkPermissionTo('restore Req');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Req');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Req $req): bool
    {
        return $user->checkPermissionTo('replicate Req');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Req');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Req $req): bool
    {
        return $user->checkPermissionTo('force-delete Req');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Req');
    }
}
