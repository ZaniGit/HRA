<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transport;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transport can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the transport can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function view(User $user, Transport $model)
    {
        return true;
    }

    /**
     * Determine whether the transport can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the transport can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function update(User $user, Transport $model)
    {
        return true;
    }

    /**
     * Determine whether the transport can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function delete(User $user, Transport $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the transport can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function restore(User $user, Transport $model)
    {
        return false;
    }

    /**
     * Determine whether the transport can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function forceDelete(User $user, Transport $model)
    {
        return false;
    }
}
