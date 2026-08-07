<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\NewsletterMember;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsletterMemberPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NewsletterMember');
    }

    public function view(AuthUser $authUser, NewsletterMember $newsletterMember): bool
    {
        return $authUser->can('View:NewsletterMember');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NewsletterMember');
    }

    public function update(AuthUser $authUser, NewsletterMember $newsletterMember): bool
    {
        return $authUser->can('Update:NewsletterMember');
    }

    public function delete(AuthUser $authUser, NewsletterMember $newsletterMember): bool
    {
        return $authUser->can('Delete:NewsletterMember');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:NewsletterMember');
    }

    public function restore(AuthUser $authUser, NewsletterMember $newsletterMember): bool
    {
        return $authUser->can('Restore:NewsletterMember');
    }

    public function forceDelete(AuthUser $authUser, NewsletterMember $newsletterMember): bool
    {
        return $authUser->can('ForceDelete:NewsletterMember');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NewsletterMember');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NewsletterMember');
    }

    public function replicate(AuthUser $authUser, NewsletterMember $newsletterMember): bool
    {
        return $authUser->can('Replicate:NewsletterMember');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NewsletterMember');
    }

}