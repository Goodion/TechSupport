<?php

namespace App\Policies;

use App\Appeal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppealPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the appeal.
     *
     * @param  \App\User  $user
     * @param  \App\Appeal  $appeal
     * @return mixed
     */
    public function view(User $user, Appeal $appeal)
    {
        return $appeal->author_id == $user->id;
    }

    /**
     * Determine whether the user can update the appeal.
     *
     * @param  \App\User  $user
     * @param  \App\Appeal  $appeal
     * @return mixed
     */
    public function update(User $user, Appeal $appeal)
    {
        return $appeal->author_id == $user->id;
    }

    /**
     * Determine whether the user can delete the appeal.
     *
     * @param  \App\User  $user
     * @param  \App\Appeal  $appeal
     * @return mixed
     */
    public function close(User $user, Appeal $appeal)
    {
        return $appeal->author_id == $user->id;
    }

    /**
     * Determine whether the user can restore the appeal.
     *
     * @param  \App\User  $user
     * @param  \App\Appeal  $appeal
     * @return mixed
     */
    public function restore(User $user, Appeal $appeal)
    {
        return $appeal->author_id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the appeal.
     *
     * @param  \App\User  $user
     * @param  \App\Appeal  $appeal
     * @return mixed
     */
    public function forceDelete(User $user, Appeal $appeal)
    {
        return $appeal->author_id == $user->id;
    }
}
