<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Sell;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Sell');
    }

    public function view(AuthUser $authUser, Sell $sell): bool
    {
        return $authUser->can('View:Sell');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Sell');
    }

    public function update(AuthUser $authUser, Sell $sell): bool
    {
        return $authUser->can('Update:Sell');
    }

    public function delete(AuthUser $authUser, Sell $sell): bool
    {
        return $authUser->can('Delete:Sell');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Sell');
    }

    public function restore(AuthUser $authUser, Sell $sell): bool
    {
        return $authUser->can('Restore:Sell');
    }

    public function forceDelete(AuthUser $authUser, Sell $sell): bool
    {
        return $authUser->can('ForceDelete:Sell');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Sell');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Sell');
    }

    public function replicate(AuthUser $authUser, Sell $sell): bool
    {
        return $authUser->can('Replicate:Sell');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Sell');
    }

}