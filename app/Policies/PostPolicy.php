<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // Implement as needed
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post)
    {
        // Implement as needed
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user ? Response::allow() : Response::deny('You must be logged in to create a post.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post)
    {
        return $this->authorizeForAction($user, $post);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        return $this->authorizeForAction($user, $post);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post)
    {
        return $this->authorizeForAction($user, $post);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post)
    {
        return $this->authorizeForAction($user, $post);
    }

    /**
     * Common authorization check for actions.
     */
    private function authorizeForAction(User $user, Post $post)
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }

        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }
}
