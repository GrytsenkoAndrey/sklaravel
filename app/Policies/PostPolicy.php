<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /*public function show(User $user, Post $post)
    {
        return $post->user_id == $user->id;
    }*/

    public function update(User $user, Post $post)
    {
        return $post->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $post->user_id == $user->id;
    }
}
