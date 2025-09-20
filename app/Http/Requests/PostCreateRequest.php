<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'description' => 'required|string|max:255',
            'image' => 'nullable|file|image|max:2048',
        ];
    }
}
