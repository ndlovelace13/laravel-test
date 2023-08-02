<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (auth()->user()->id != $user->id)
            return auth()->user()->following()->toggle($user->profile);
    }
}
