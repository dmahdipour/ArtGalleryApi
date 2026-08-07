<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Style;
use Illuminate\Auth\Access\HandlesAuthorization;

class StylePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Style');
    }

    public function view(AuthUser $authUser, Style $style): bool
    {
        return $authUser->can('View:Style');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Style');
    }

    public function update(AuthUser $authUser, Style $style): bool
    {
        return $authUser->can('Update:Style');
    }

    public function delete(AuthUser $authUser, Style $style): bool
    {
        return $authUser->can('Delete:Style');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Style');
    }

    public function restore(AuthUser $authUser, Style $style): bool
    {
        return $authUser->can('Restore:Style');
    }

    public function forceDelete(AuthUser $authUser, Style $style): bool
    {
        return $authUser->can('ForceDelete:Style');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Style');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Style');
    }

    public function replicate(AuthUser $authUser, Style $style): bool
    {
        return $authUser->can('Replicate:Style');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Style');
    }

}