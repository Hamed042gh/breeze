<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
     
        $user = User::with('posts')->find($id);

        if (!$user) {
            return redirect('/posts');
        }

        $posts = $user->posts;
        $postCount = $posts->count();

        return view('profile.show', compact('posts', 'user', 'postCount'));
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

        Gate::authorize('update', $post);

        $post->update($request->all());

        return redirect()->route('profile.show', $post->user_id)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('profile.show', $post->user_id)->with('success', 'Post deleted successfully.');
    }
}
