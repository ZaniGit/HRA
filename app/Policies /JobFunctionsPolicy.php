<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobFunctions;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobFunctionsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobFunctions can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobFunctions can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobFunctions  $model
     * @return mixed
     */
    public function view(User $user, JobFunctions $model)
    {
        return true;
    }

    /**
     * Determine whether the jobFunctions can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobFunctions can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobFunctions  $model
     * @return mixed
     */
    public function update(User $user, JobFunctions $model)
    {
        return true;
    }

    /**
     * Determine whether the jobFunctions can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobFunctions  $model
     * @return mixed
     */
    public function delete(User $user, JobFunctions $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobFunctions  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the jobFunctions can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobFunctions  $model
     * @return mixed
     */
    public function restore(User $user, JobFunctions $model)
    {
        return false;
    }

    /**
     * Determine whether the jobFunctions can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobFunctions  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobFunctions $model)
    {
        return false;
    }
}
