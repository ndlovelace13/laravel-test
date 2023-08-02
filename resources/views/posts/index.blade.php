@extends('layouts.app')

@section('content')
<div class="container">
    @if ($posts->total() == 0)
        <div class="row">
            <div class="col-8 offset-2">
                <h2 style="text-align: center">There is no content to display - looks like you're new around here!</h2>
                <p style="text-align: center" class="pt-4">Click <a href="/profile/{{$id}}">here</a> to visit your profile. Feel free to customize your profile and post any images you'd like!</p>
            </div>
        </div>
        <hr>
    @endif
    <div class="row d-flex">
        <div class="col-6 offset-3">
            <h1 style="text-align: center">DISCOVER</h1>
            <h3 style="text-align: center">Feeling Adventurous?</h3>
            <p style="text-align: center">There are currently {{$userCount}} user accounts on this application. Click below to visit a random user's profile!</p>
            <div class="text-center">
                <a href="/profile/{{$randUser}}"><button class="btn btn-primary">Random Profile</button></a>
            </div>
        </div>
    </div>
    <hr class="pt-3 pb-3">
    @foreach($posts as $post)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/p/{{$post->id}}"><img src="/{{ $post->image}}" alt="" class="w-100"></a>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div class="d-flex">
                    <?php $likes = (auth()->user()) ? auth()->user()->liking->contains($post->id) : false;?>
                    <like-button post-id="{{$post->id}}" likes="{{$likes}}"></like-button>
                    <a href="/p/{{$post->id}}"><button class="btn btn-primary ms-2">Comment</button></a>
                </div>
                <p class="mb-0">
                    <span class="fw-bolder">
                        <a href="/profile/{{$post->user->id}}" class="text-decoration-none">
                            <span class="text-dark">{{$post->user->username}}</span>
                        </a>
                    </span>
                    {{$post->caption}}
                </p>
                <p class="mb-0"><strong>{{$post->likers->count()}}</strong> likes</p>
                <div>
                    @foreach ($post->comments as $comment)
                        @if($loop->index < 2)
                            <div class="d-flex align-items-center">
                                <p class="my-auto">
                                    <span class="fw-bolder">
                                        <a href="/profile/{{$comment->user_id}}" class="text-decoration-none">
                                            <span class="text-dark">{{$comment->user->username}}</span>
                                        </a>
                                    </span>
                                    {{$comment->content}}
                                </p>
                            </div>
                        @endif
                    @endforeach
                    @if ($post->comments->count() > 2)
                        <a href="/p/{{$post->id}}" class="text-decoration-none text-dark">View all {{$post->comments->count()}} comments</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection
