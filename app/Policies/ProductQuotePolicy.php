<?php

namespace App\Policies;

use App\Models\ProductQuote;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductQuotePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ProductQuote $productQuote): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ProductQuote $productQuote): bool
    {
    }

    public function delete(User $user, ProductQuote $productQuote): bool
    {
    }

    public function restore(User $user, ProductQuote $productQuote): bool
    {
    }

    public function forceDelete(User $user, ProductQuote $productQuote): bool
    {
    }
}
