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

        $user = User::find($id);

        if (!$user) {
            return redirect('/posts')->with('error', 'User not authenticated.');
        }

        if ($user->posts->isEmpty()) {
            return redirect()->back()->with('error', 'No posts found for this user.');
        }
        $posts = $user->posts;

        $postCount = $user->posts->count();

        return view('profile.post.show', compact('posts', 'user', 'postCount'));
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

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
