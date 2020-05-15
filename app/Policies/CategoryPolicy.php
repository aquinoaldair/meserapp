<?php

namespace App\Policies;

use App\Models\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Category $category)
    {
        return ($user->commerce->id == $category->commerce_id || $user->isAdmin() || $category->createdByAdmin());
    }

    public function edit(User $user, Category $category){
        return ($user->commerce->id == $category->commerce_id || $user->isAdmin());
    }

    public function update(User $user, Category $category)
    {
        return ($user->commerce->id == $category->commerce_id || $user->isAdmin());
    }

    public function delete(User $user, Category $category)
    {
        return ($user->commerce->id == $category->commerce_id || $user->isAdmin());
    }

}
