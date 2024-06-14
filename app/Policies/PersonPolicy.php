<?php

namespace App\Policies;

use App\Models\Person;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        
    }

    public function view(User $user, Person $person): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Person $person): bool
    {
    }

    public function delete(User $user, Person $person): bool
    {
    }

    public function restore(User $user, Person $person): bool
    {
    }

    public function forceDelete(User $user, Person $person): bool
    {
    }
}
