<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name' => 'required|string|max:225',
            'description' => 'required|string',
            'image' => 'sometimes|file|image|mimes:jpg,png',
            'start_from' => 'required|date_format:Y-m-d',
            'end_to' => 'required|date_format:Y-m-d',
        ];
    }
}
