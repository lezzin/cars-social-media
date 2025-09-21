<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $userId = $request->user()->id;

        $alreadyLiked = $post->likes()->where('user_id', $userId)->exists();

        if ($alreadyLiked) {
            $post->likes()->where('user_id', $userId)->delete();
            $post->decrement('likes_count');
        } else {
            $post->likes()->create(['user_id' => $userId]);
            $post->increment('likes_count');
        }

        $post->refresh();

        return response()->json([
            'post_id'       => $post->id,
            'likes_count'   => $post->likes_count,
            'liked_by_user' => ! $alreadyLiked,
        ]);
    }
}
