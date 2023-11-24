<?php

namespace App\Policies;

use App\Models\ContainerType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContainerTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
        //return $user->hasRole('CoordinationOfficer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContainerType $containerType): bool
    {
        return true;
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContainerType $containerType): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContainerType $containerType): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ContainerType $containerType): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ContainerType $containerType): bool
    {
        return true;
        //
    }
}
