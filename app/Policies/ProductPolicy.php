<?php

namespace App\Policies;

use App\Models\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Product $product)
    {
        return $user->commerce->id == $product->commerce_id;
    }

    public function update(User $user, Product $product)
    {
        return $user->commerce->id == $product->commerce_id;
    }

    public function delete(User $user, Product $product)
    {
        return $user->commerce->id == $product->commerce_id;
    }

}
