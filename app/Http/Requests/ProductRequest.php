<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'sometimes|file|image|mimes:jpg,png',
            'price' => 'required|string|max:255',
            'price_of_sale' => 'nullable|string|max:255',
            'preparation_time' => 'required|string|max:255',
            'restaurant_id' => 'required|exists:restaurants,id'
        ];
    }
}
