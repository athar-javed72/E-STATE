<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'type' => 'required|in:house,apartment,condo,villa,plot,commercial,townhouse',
            'listing_type' => 'required|in:for_sale,for_rent',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|integer|min:0',
            'parking' => 'nullable|integer|min:0',
            'agent_id' => 'nullable|exists:agents,id',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'featured' => 'boolean',
            'status' => 'in:active,sold,pending,inactive',
        ];
    }
}
