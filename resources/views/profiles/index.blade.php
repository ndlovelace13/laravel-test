@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{$user->profile->profileImage()}}"  class="w-100 img-responsive rounded-circle" alt="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{$user->username}}</div >
                    @if($user->id != auth()->user()->id)
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                    @endif
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pe-5"><strong>{{$postCount}}</strong> posts</div>
                <a href="/profile/{{$user->id}}/followers" class="text-decoration-none">
                    <div class="pe-5 text-dark">
                        <strong>{{$followersCount}}</strong> followers
                    </div>
                </a>
                <a href="/profile/{{$user->id}}/following" class="text-decoration-none">
                    <div class="pe-5 text-dark">
                        <strong>{{$followingCount}}</strong> following
                    </div>
                </a>
            </div>
            <div class="pt-4"><strong>{{$user->profile->title}}</strong></div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}">{{$user->profile->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}">
                    <img src="/{{$post->image}}" alt="" class="w-100">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
