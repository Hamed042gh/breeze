<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{

    /**
     * Display the specified resource.
     */
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

        return view('profile.post.show', compact('posts','user', 'postCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $post->update($request->all());

        return redirect()->route('profile.show', $post->user_id)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $post->delete();

        return redirect()->route('profile.show', $post->user_id)->with('success', 'Post deleted successfully.');
    }
}
