<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('post.index', [
            'title' => 'Post',
            'posts' => Post::latest()->get()
        ]);
    }
}