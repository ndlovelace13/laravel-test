<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user){
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id, 
            now()->addSeconds(30),
            function () use ($user){
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id, 
            now()->addSeconds(30),
            function () use ($user){
                return $user->following->count();
            });

        return view('profiles.index', compact('user', 'follows', 'postCount','followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function followers(User $user)
    {
        $followers = $user->profile->followers;
        //dd($followers);
        return view('profiles.followers', compact('user', 'followers'));
    }

    public function following(User $user)
    {
        $following = $user->following;
        //dd($following);
        return view('profiles.following', compact('user','following'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'url' => 'url|nullable',
            'image' => '',
        ]);

        if (request('image'))
        {
            $imagePath = request('image')->store('profile', 'public');
            //dd($imagePath);
            $image = Image::make(base_path("public/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        

        return redirect("/profile/{$user->id}");
    }
}
