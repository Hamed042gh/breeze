<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
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
        Gate::authorize('create', Post::class);
        return view('post.create');
    }



    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $post = Post::create($validatedData);
        Mail::to('hello@example.com')->send(new PostCreated($post));

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }
}
