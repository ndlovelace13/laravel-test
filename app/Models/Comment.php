<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function timeSince()
    {
        $timestamp = $this->created_at;
        $time = now()->diffInWeeks($timestamp);
        $label = " weeks ago";
        if ($time < 1)
        {
            $time = now()->diffInDays($timestamp);
            $label = " days ago";
        }
        if ($time < 1)
        {
            $time = now()->diffInHours($timestamp);
            $label = " hours ago";
        }
        if ($time < 1)
        {
            $time = now()->diffInMinutes($timestamp);
            $label = " mins ago";
        }
        if ($time < 1)
        {
            $time = now()->diffInSeconds($timestamp);
            $label = " seconds ago";
        }
        return $time . $label;
    }
}
