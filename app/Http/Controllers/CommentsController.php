<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        $data = request()->validate([
            'content' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'content' => $data['content'],
            'post_id' => $post->id,
        ]);

        //dd($post->comments);
        
        return redirect('/p/' . $post->id);
    }
}
