<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dependent;
use Illuminate\Auth\Access\HandlesAuthorization;

class DependentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the dependent can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the dependent can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Dependent  $model
     * @return mixed
     */
    public function view(User $user, Dependent $model)
    {
        return true;
    }

    /**
     * Determine whether the dependent can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the dependent can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Dependent  $model
     * @return mixed
     */
    public function update(User $user, Dependent $model)
    {
        return true;
    }

    /**
     * Determine whether the dependent can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Dependent  $model
     * @return mixed
     */
    public function delete(User $user, Dependent $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Dependent  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the dependent can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Dependent  $model
     * @return mixed
     */
    public function restore(User $user, Dependent $model)
    {
        return false;
    }

    /**
     * Determine whether the dependent can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Dependent  $model
     * @return mixed
     */
    public function forceDelete(User $user, Dependent $model)
    {
        return false;
    }
}
