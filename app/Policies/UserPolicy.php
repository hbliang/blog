<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization, SuperAdminBeforeTrait;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->can('view-user');
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create-user');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $currentUser
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->can('update-user');
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $currentUser
     * @return mixed
     */
    public function delete(User $currentUser)
    {
        return $currentUser->can('delete-user');
    }

    public function updateRole(User $user)
    {
        dd(1);
        return $user->can('update-user-role');
    }
}
