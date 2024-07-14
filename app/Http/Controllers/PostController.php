<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Menampilkan semua data (GET)
    public function layouts()
    {
        $posts = Post::all();
        return view('layouts.index', compact('posts'));
    }

    // Menampilkan form untuk membuat data baru (GET)
    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan data baru (POST)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat.');
    }

    // Menampilkan data spesifik (GET)
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Menampilkan form untuk mengedit data (GET)
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Memperbarui data yang ada (PUT/PATCH)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    // Menghapus data (DELETE)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }
}
