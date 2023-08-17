<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employe;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the employe can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the employe can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Employe  $model
     * @return mixed
     */
    public function view(User $user, Employe $model)
    {
        return true;
    }

    /**
     * Determine whether the employe can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the employe can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Employe  $model
     * @return mixed
     */
    public function update(User $user, Employe $model)
    {
        return true;
    }

    /**
     * Determine whether the employe can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Employe  $model
     * @return mixed
     */
    public function delete(User $user, Employe $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Employe  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the employe can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Employe  $model
     * @return mixed
     */
    public function restore(User $user, Employe $model)
    {
        return false;
    }

    /**
     * Determine whether the employe can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Employe  $model
     * @return mixed
     */
    public function forceDelete(User $user, Employe $model)
    {
        return false;
    }
}
