<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\NewsletterMember;
use App\Models\User;

class NewsletterMemberPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any NewsletterMember');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NewsletterMember $newslettermember): bool
    {
        return $user->checkPermissionTo('view NewsletterMember');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create NewsletterMember');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NewsletterMember $newslettermember): bool
    {
        return $user->checkPermissionTo('update NewsletterMember');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NewsletterMember $newslettermember): bool
    {
        return $user->checkPermissionTo('delete NewsletterMember');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any NewsletterMember');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NewsletterMember $newslettermember): bool
    {
        return $user->checkPermissionTo('restore NewsletterMember');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any NewsletterMember');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, NewsletterMember $newslettermember): bool
    {
        return $user->checkPermissionTo('replicate NewsletterMember');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder NewsletterMember');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NewsletterMember $newslettermember): bool
    {
        return $user->checkPermissionTo('force-delete NewsletterMember');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any NewsletterMember');
    }
}
