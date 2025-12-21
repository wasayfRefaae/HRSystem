<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\IncidentRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidentRequestPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:IncidentRequest');
    }

    public function view(AuthUser $authUser, IncidentRequest $incidentRequest): bool
    {
        return $authUser->can('View:IncidentRequest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:IncidentRequest');
    }

    public function update(AuthUser $authUser, IncidentRequest $incidentRequest): bool
    {
        return $authUser->can('Update:IncidentRequest');
    }

    public function delete(AuthUser $authUser, IncidentRequest $incidentRequest): bool
    {
        return $authUser->can('Delete:IncidentRequest');
    }

    public function restore(AuthUser $authUser, IncidentRequest $incidentRequest): bool
    {
        return $authUser->can('Restore:IncidentRequest');
    }

    public function forceDelete(AuthUser $authUser, IncidentRequest $incidentRequest): bool
    {
        return $authUser->can('ForceDelete:IncidentRequest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:IncidentRequest');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:IncidentRequest');
    }

    public function replicate(AuthUser $authUser, IncidentRequest $incidentRequest): bool
    {
        return $authUser->can('Replicate:IncidentRequest');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:IncidentRequest');
    }

}