<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserProfileController extends Controller
{

    public function showUserPosts($id)
    {
        $user = $this->findUserById($id);

        if (!$user) {
            return $this->redirectWithError('/posts', 'User not authenticated.');
        }

        $posts = $user->posts;

        if ($posts->isEmpty()) {
            return $this->redirectWithErrorBack('No posts found for this user.');
        }

        $postCount = $posts->count();

        return view('profile.post.show', compact('posts', 'user', 'postCount'));
    }


    private function findUserById($id)
    {
        return User::find($id);
    }


    private function redirectWithError($route, $message)
    {
        return redirect($route)->with('error', $message);
    }


    private function redirectWithErrorBack($message)
    {
        return redirect()->back()->with('error', $message);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editUserPosts(Post $post)
    {
        Gate::authorize('update', $post);
        return view('profile.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUserPosts(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $post->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUserPosts(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }
}
