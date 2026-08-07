<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Technique;
use Illuminate\Auth\Access\HandlesAuthorization;

class TechniquePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Technique');
    }

    public function view(AuthUser $authUser, Technique $technique): bool
    {
        return $authUser->can('View:Technique');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Technique');
    }

    public function update(AuthUser $authUser, Technique $technique): bool
    {
        return $authUser->can('Update:Technique');
    }

    public function delete(AuthUser $authUser, Technique $technique): bool
    {
        return $authUser->can('Delete:Technique');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Technique');
    }

    public function restore(AuthUser $authUser, Technique $technique): bool
    {
        return $authUser->can('Restore:Technique');
    }

    public function forceDelete(AuthUser $authUser, Technique $technique): bool
    {
        return $authUser->can('ForceDelete:Technique');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Technique');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Technique');
    }

    public function replicate(AuthUser $authUser, Technique $technique): bool
    {
        return $authUser->can('Replicate:Technique');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Technique');
    }

}