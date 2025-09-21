<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function create(PostCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $data['image'] = $this->handleFileUpload(
            $request->file('image'),
            'posts'
        );

        Post::create($data);

        return Redirect::route('dashboard');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(Response::HTTP_FORBIDDEN, 'Ação não autorizada');
        }

        if ($post->image_path) {
            Storage::delete($post->image_path);
        }

        $post->delete();

        return redirect()->route('dashboard');
    }
}
