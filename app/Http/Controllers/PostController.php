<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view("index", compact("posts"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('/images/posts'), $imageName);
        }
        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => $imageName
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($request->hasFile('image')) {
            if (file_exists(public_path('images/posts/' . $post->image))) {
                unlink(public_path('images/posts/' . $post->image));
            }
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/posts'), $imageName);
            $post->image = $imageName;
        }
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName ?? $post->image,
        ]);
        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (file_exists(public_path('images/posts/' . $post->image))) {
            unlink(public_path('images/posts/' . $post->image));
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
