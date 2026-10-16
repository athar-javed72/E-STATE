<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        return $user instanceof User && $user->isAdmin();
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'status' => 'in:active,inactive',
        ];
    }
}
