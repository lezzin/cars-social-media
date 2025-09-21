<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id']
        ];
    }
}
