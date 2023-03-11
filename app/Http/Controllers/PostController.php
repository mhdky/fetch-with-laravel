<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function data() {
        $posts = Post::latest()->get();
        return response()->json(['posts' => $posts]);
    }

    public function index() {
        return view('post.index', [
            'title' => 'Post',
            'posts' => Post::latest()->get()
        ]); 
    }

    public function search($searchText) {
        $posts = Post::where('title', 'like', '%'.$searchText.'%')->get();

        return response()->json($posts);
    }
}