<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $post = Post::with('user')->get();
        return view('post.index', compact('posts'));
    }

    public function update (Post $post)
    {
        return "You are able to see this post";
    }
}
