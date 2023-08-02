@extends('layouts.app')

@section('content')
<div class="container">
    @if ($following->count() == 0)
        <div class="row">
            <div class="col-8 offset-2">
                <h2 style="text-align: center">This user isn't following anyone</h2>
            </div>
        </div>
        <hr>
    @endif
    @if ($following->count() > 0)
        <h1 style="text-align: center">Users Followed by {{$user->username}}</h1>
        <hr class="pt-2 pb-2">
        <div class="row pt-2 pb-2">
            @foreach($following as $following)
                <div class="col-4 d-flex justify-content-center">
                    <div>
                        <a href="/profile/{{$following->user->id}}"><img src="{{$following->profileImage()}}" alt="" class=" rounded-circle" style="max-width: 100px"></a>
                    </div>
                    <div class="ps-3 my-auto">
                        <p>
                            <span class="fw-bolder">
                                <a href="/profile/{{$following->user->id}}" class="text-decoration-none">
                                    <span class="text-dark">{{$following->user->username}}</span>
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
