<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function dashboard()
    {
        $authUserId = Auth::id();

        $posts = Post::with('user:id,name,email,username,image')
            ->withExists(['likes as liked_by_user' => fn($q) => $q->where('user_id', $authUserId)])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();

        return Inertia::render('Dashboard/Home', [
            'posts' => PostResource::collection($posts)->resolve(),
        ]);
    }
}
