<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::latest()->get();
        return view('home', [
        'title' => 'Home',
        'posts' => $posts,
        'searchResults' => []
        ]);
    }

    public function search(Request $request) {
        $searchTerm = $request->input('search');
        $posts = Post::where('title', 'like', '%'.$searchTerm.'%')->get();
        return response()->json($posts);
    }
}
