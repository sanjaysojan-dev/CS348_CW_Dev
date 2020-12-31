<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserFilmProfile;
use App\Models\UserFilmProfileController;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserFilmProfilePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->admin == false;
    }

}
