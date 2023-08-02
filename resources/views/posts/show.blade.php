@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/{{ $post->image}}" alt="" class="w-100">
        </div>
        <div class="col-4" style="position:relative">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pe-3">
                        <img src="{{$post->user->profile->profileImage()}}" alt="" class = "rounded-circle w-100" style="max-width: 50px">
                    </div>
                    <div>
                        <div class="fw-bolder d-flex align-items-center">
                            <a href="/profile/{{$post->user->id}}" class="text-decoration-none">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a>
                            @if (!$follows)
                                <follow-button user-id="{{$post->user->id}}" follows="{{$follows}}"></follow-button>
                            @endif
                            <like-button post-id="{{$post->id}}" likes="{{$likes}}" class="ms-3"></like-button>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex align-items-center">
                    <div class="pe-3">
                        <img src="{{$post->user->profile->profileImage()}}" alt="" class = "rounded-circle w-100" style="max-width: 50px">
                    </div>
                    <p class="my-auto">
                        <span class="fw-bolder">
                            <a href="/profile/{{$post->user->id}}" class="text-decoration-none">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a>
                        </span>
                        {{$post->caption}}
                    </p>
                </div>
            </div>
            @foreach ($post->comments as $comment)
            <div class="d-flex align-items-center pt-3">
                <div class="pe-3">
                    <img src="{{$comment->user->profile->profileImage()}}" alt="" class = "rounded-circle w-100" style="max-width: 50px">
                </div>
                <div>
                    <p class="my-auto">
                        <span class="fw-bolder">
                            <a href="/profile/{{$comment->user_id}}" class="text-decoration-none">
                                <span class="text-dark">{{$comment->user->username}}</span>
                            </a>
                        </span>
                        {{$comment->content}}
                    </p>
                    <p>
                        <span style="position: absolute; color: gray">
                            {{$comment->timeSince()}}
                        </span>
                    </p>
                </div>
            </div>
            @endforeach
            <div style="position:absolute; bottom:0;">
                <form action="/comment/{{$post->id}}" method="POST" class="d-flex align-items-center pt-3">
                @csrf
                    <input id="content" name="content" type="text" class="form-control @error('content') is-invalid @enderror">
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <a href="" class="ps-2"><button class="btn btn-primary">Post</button></a>
                </form>
            </div>
        </div>
    </div>
        @can('delete', $post)
        <div class="row pt-5 align-items-center">
            <a href="/p/{{$post->id}}/delete" style="text-align:center"><button class="btn btn-primary">Delete Post</button></a>
        </div>
        @endcan
</div>
@endsection
