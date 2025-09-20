<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')
            ->latest()
            ->get()
            ->map(fn($post) => [
                'id' => $post->id,
                'description' => $post->description,
                'image_url' => $post->image_url,
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'email' => $post->user->email,
                    'image_url' => $post->user->image_url,
                    'username' =>  $post->user->username
                ],
            ]);

        return Inertia::render('Dashboard/Home', [
            'posts' => $posts,
        ]);
    }
}
