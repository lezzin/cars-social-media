<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $data['content'],
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        $post->increment('comments_count');

        return back()->with('success', 'Comentário adicionado!');
    }

    public function get(Request $request, Post $post)
    {
        $comments = $post->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'comments' => $comments,
        ]);
    }
}
