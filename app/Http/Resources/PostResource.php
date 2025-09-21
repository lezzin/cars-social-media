<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'image' => $this->image,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'username' => $this->user->username,
                'image' => $this->user->image,
            ],
            'likes_count' => $this->likes_count,
            'comments_count' => $this->comments_count,
            'liked_by_user' => $this->liked_by_user,
            'created_at' => $this->created_at->format('d/m/Y H:i:s'),
        ];
    }
}
