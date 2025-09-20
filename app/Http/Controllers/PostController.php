<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function create(PostCreateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);
    }
}
