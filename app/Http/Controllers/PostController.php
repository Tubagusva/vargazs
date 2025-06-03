<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedPost;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('my-profile')->with('success', 'Post berhasil dibuat!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $saved = SavedPost::where('post_id', $id)->where('user_id', Auth::id())->exists();
        return view('post.show', compact('post', 'saved'));
    }

    public function save($id)
    {
        $post = Post::findOrFail($id);

        SavedPost::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return redirect()->back()->with('success', 'Disimpan!');
    }

    public function saved()
    {
        $savedPosts = Auth::user()->savedPosts()->with('post')->get();
        return view('post.saved', compact('savedPosts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post berhasil diupdate!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('my-profile')->with('success', 'Post berhasil dihapus!');
    }   
}
