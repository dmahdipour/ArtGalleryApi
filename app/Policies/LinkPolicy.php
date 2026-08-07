<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Link;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Link');
    }

    public function view(AuthUser $authUser, Link $link): bool
    {
        return $authUser->can('View:Link');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Link');
    }

    public function update(AuthUser $authUser, Link $link): bool
    {
        return $authUser->can('Update:Link');
    }

    public function delete(AuthUser $authUser, Link $link): bool
    {
        return $authUser->can('Delete:Link');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Link');
    }

    public function restore(AuthUser $authUser, Link $link): bool
    {
        return $authUser->can('Restore:Link');
    }

    public function forceDelete(AuthUser $authUser, Link $link): bool
    {
        return $authUser->can('ForceDelete:Link');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Link');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Link');
    }

    public function replicate(AuthUser $authUser, Link $link): bool
    {
        return $authUser->can('Replicate:Link');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Link');
    }

}