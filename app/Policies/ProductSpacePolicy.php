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

    }

    public function view(User $user, ProductSpace $productSpace): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ProductSpace $productSpace): bool
    {
    }

    public function delete(User $user, ProductSpace $productSpace): bool
    {
    }

    public function restore(User $user, ProductSpace $productSpace): bool
    {
    }

    public function forceDelete(User $user, ProductSpace $productSpace): bool
    {
    }
}
