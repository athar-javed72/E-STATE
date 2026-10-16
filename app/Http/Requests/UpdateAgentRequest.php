<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgentRequest extends FormRequest
{
    public function authorize(): bool
    {
        \ = \->user();\r\n\r\n        return \ instanceof \\App\\Models\\User && \->isAdmin();
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_online' => 'boolean',
            'status' => 'in:active,inactive',
        ];
    }
}
