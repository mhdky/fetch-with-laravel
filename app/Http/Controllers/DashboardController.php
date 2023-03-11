<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index',[
            'title' => 'Dashboard',
            'posts' => Post::latest()->get(),
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'category_id' => 'required|max:254',
            'title' => 'required|min:3|max:254',
            'slug' => 'required|min:3|max:254',
            'author' => 'required|min:3|max:254',
            'excerpt' => 'required|min:3|max:254',
        ]);

        Post::create($validateData);

        return redirect('/dashboard')->with('ok', 'Data berhasil ditambahkan');
    }

    public function destroy(Post $post) {
        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ]);
    }
}
