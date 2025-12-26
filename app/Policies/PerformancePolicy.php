<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Performance;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerformancePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Performance');
    }

    public function view(AuthUser $authUser, Performance $performance): bool
    {
        return $authUser->can('View:Performance');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Performance');
    }

    public function update(AuthUser $authUser, Performance $performance): bool
    {
        return $authUser->can('Update:Performance');
    }

    public function delete(AuthUser $authUser, Performance $performance): bool
    {
        return $authUser->can('Delete:Performance');
    }

    public function restore(AuthUser $authUser, Performance $performance): bool
    {
        return $authUser->can('Restore:Performance');
    }

    public function forceDelete(AuthUser $authUser, Performance $performance): bool
    {
        return $authUser->can('ForceDelete:Performance');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Performance');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Performance');
    }

    public function replicate(AuthUser $authUser, Performance $performance): bool
    {
        return $authUser->can('Replicate:Performance');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Performance');
    }

}