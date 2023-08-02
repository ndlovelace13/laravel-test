<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $userCount = User::count();

        $randUser = rand(1, $userCount);

        $id = auth()->user()->id;

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts', 'id', 'userCount', 'randUser'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/profile/' . auth()->user()->id);
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        //dd($imagePath);
        $image = Image::make(base_path("public/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        $likes = (auth()->user()) ? auth()->user()->liking->contains($post->id) : false;

        return view('posts.show', compact('post','follows','likes'));
    }
}
