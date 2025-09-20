<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $authUserId = Auth::id();

        $posts = Post::with('user')
            ->withExists(['likes as liked_by_user' => fn($q) => $q->where('user_id', $authUserId)])
            ->latest()
            ->get()
            ->map(fn($post) => [
                'id' => $post->id,
                'description' => $post->description,
                'image' => $post->image,
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'email' => $post->user->email,
                    'image' => $post->user->image,
                    'username' => $post->user->username,
                ],
                'likes_count' => $post->likes_count,
                'comments_count' => $post->comments_count,
                'liked_by_user' => $post->liked_by_user,
                'created_at' => Carbon::parse($post->created_at)->format('d/m/Y H:i:s')
            ]);

        return Inertia::render('Dashboard/Home', [
            'posts' => $posts,
        ]);
    }
}
