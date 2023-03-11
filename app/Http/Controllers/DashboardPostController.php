<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    public function index() {
        return view('dashboard.post', [
            'title' => 'Post in Dashboard',
            'posts' => Post::latest()->get(),
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {
        // Validate the form data
        $validatedData = $request->validate([
            'category' => 'required',
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts|max:255',
            'author' => 'required|max:255',
            'excerpt' => 'required|max:255',
        ]);

        // Create a new post with the validated data
        $post = new Post();
        $post->category_id = $validatedData['category'];
        $post->title = $validatedData['title'];
        $post->slug = $validatedData['slug'];
        $post->author = $validatedData['author'];
        $post->excerpt = $validatedData['excerpt'];
        $post->save();

        // Return a success response
        return response()->json(['message' => 'Post created successfully']);
    }
}
