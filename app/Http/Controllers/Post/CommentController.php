<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function store(CommentCreateRequest $request, Post $post)
    {
        $data = $request->validated();

        $post->comments()->create([
            'user_id'   => $request->user()->id,
            'content'   => $data['content'],
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        $post->increment('comments_count');

        return Redirect::back()->with('success', 'Comentário adicionado!');
    }

    public function get(Request $request, Post $post)
    {
        $comments = $post->comments()
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return response()->json([
            'comments' => CommentResource::collection($comments)->resolve(),
        ]);
    }
}
