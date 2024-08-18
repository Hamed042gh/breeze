<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('post.show', compact('posts'));
    }


    public function create()
    {

        return view('post.create');
    }



    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        Post::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Post $post)
    // {
    //     return view('post.show', compact('post'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Post $post)
    // {

    //     return view('post.edit', compact('post'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Post $post)
    // {

    //     $policy = Gate::authorize('update', $post);


    //     $post->update($request->all());

    //     return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Post $post)
    // {
    //     Gate::authorize('delete', $post);

    //     $post->delete();

    //     return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    // }
}
