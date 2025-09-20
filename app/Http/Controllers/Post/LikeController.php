<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $user = $request->user();
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $post->decrement('likes_count');
            $likedByUser = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $post->increment('likes_count');
            $likedByUser = true;
        }

        $post->refresh();

        return response()->json([
            'post_id'       => $post->id,
            'likes_count'   => $post->likes_count,
            'liked_by_user' => $likedByUser,
        ]);
    }
}
