<?php

namespace App\Policies;

use App\Models\ProductSpace;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductSpacePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductSpace $productSpace): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductSpace $productSpace): bool
    {
        return true;
    }

    public function delete(User $user, ProductSpace $productSpace): bool
    {
        return true;
    }

    public function restore(User $user, ProductSpace $productSpace): bool
    {
        return true;
    }

    public function forceDelete(User $user, ProductSpace $productSpace): bool
    {
        return true;
    }
}
