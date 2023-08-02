@extends('layouts.app')

@section('content')
<div class="container">
    @if ($followers->count() == 0)
        <div class="row">
            <div class="col-8 offset-2">
                <h2 style="text-align: center">This user doesn't have any followers</h2>
            </div>
        </div>
        <hr>
    @endif
    @if ($followers->count() > 0)
        <h1 style="text-align: center">Followers of {{$user->username}}</h1>
        <hr class="pt-2 pb-2">
        <div class="row pt-2 pb-2 d-flex justify-content-center">
            @foreach($followers as $follower)
                <div class="col-4 d-flex justify-content-center">
                    <div>
                        <a href="/profile/{{$follower->id}}"><img src="{{$follower->profile->profileImage()}}" alt="" class="rounded-circle" style="max-width: 100px"></a>
                    </div>
                    <div class="ps-3 my-auto">
                        <p>
                            <span class="fw-bolder">
                                <a href="/profile/{{$follower->id}}" class="text-decoration-none">
                                    <span class="text-dark">{{$follower->username}}</span>
                                </a>
                            </span>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
