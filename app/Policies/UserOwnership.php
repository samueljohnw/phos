<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserOwnership
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function show($user, $model)
    {
      return $user->id === $model->user_id;
    }

    public function update($user, $model)
    {
      return $user->id === $model->user_id;
    }
}
