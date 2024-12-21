<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PostController extends Controller
{
    use AuthorizesRequests;
    //Display a listing of the resource.
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view("posts.create");
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $images_arr = array();
            foreach ($request->image as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                array_push($images_arr, $imageName);
                $image->move(public_path('/images/posts'), $imageName);
            }
        }
        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => isset($images_arr) ? $images_arr : NULL
        ]);
        return redirect()->route('posts.index');
    }

    //Display the specified resource.
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    //Show the form for editing the specified resource.
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Post $post)
    {
        $images_arr = array();
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        if ($request->hasFile('image')) {
            if ($post->image) {
                foreach ($post->image as $image) {
                    if (file_exists(public_path('images/posts/' . $image))) {
                        unlink(public_path('images/posts/' . $image));
                    }
                }
            }
            foreach ($request->image as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/posts'), $imageName);
                array_push($images_arr, $imageName);
            }
            $post->image = $images_arr;
        }
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $post->image
        ]);
        return redirect()->route('posts.index');
    }

    //Remove the specified resource from storage.
    public function destroy(Post $post)
    {
        $this->authorize('manageUser', User::class);
        if ($post->image) {
            foreach ($post->image as $image) {
                if (file_exists(public_path('images/posts/' . $image))) {
                    unlink(public_path('images/posts/' . $image));
                }
            }
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
