<?php

namespace App\Policies;

use App\Models\ProductProjectProvider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductProjectProviderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductProjectProvider $productProjectProvider): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductProjectProvider $productProjectProvider): bool
    {
        return true;
    }

    public function delete(User $user, ProductProjectProvider $productProjectProvider): bool
    {
        return true;
    }

    public function restore(User $user, ProductProjectProvider $productProjectProvider): bool
    {
        return true;
    }

    public function forceDelete(User $user, ProductProjectProvider $productProjectProvider): bool
    {
        return true;
    }
}
