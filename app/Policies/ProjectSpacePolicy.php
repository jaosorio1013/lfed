<?php

namespace App\Policies;

use App\Models\ProjectSpace;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectSpacePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        
    }

    public function view(User $user, ProjectSpace $projectSpace): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ProjectSpace $projectSpace): bool
    {
    }

    public function delete(User $user, ProjectSpace $projectSpace): bool
    {
    }

    public function restore(User $user, ProjectSpace $projectSpace): bool
    {
    }

    public function forceDelete(User $user, ProjectSpace $projectSpace): bool
    {
    }
}
