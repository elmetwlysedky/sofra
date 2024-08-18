<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantRequest extends FormRequest
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

        if (request()->isMethod('put')) {
            return [
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:11|' . Rule::unique('restaurants', 'phone')->ignore($this->id),
                'phone_owner' => 'required|numeric|digits:11|unique:restaurants,phone_owner,' . $this->id,
                'email' => 'required|string|email|unique:restaurants,email,' . $this->id,
                'password' => 'nullable|string|confirmed',
                'region_id' => 'required|exists:regions,id',
                'category_id' => 'required|exists:categories,id',
                'minimum_order' => 'required|numeric|not_in:0',
                'delivery_charge' => 'nullable|numeric',
                'whats_app' => 'required|numeric|digits:11|unique:restaurants,whats_app,' . $this->id,
                'image' => 'nullable|file|image|mimes:jpg,png',
            ];
                } else {
            return [
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:11|unique:restaurants,phone,',
                'phone_owner' => 'required|numeric|digits:11|unique:restaurants,phone_owner',
                'email' => 'required|string|email|unique:restaurants,email',
                'password' => 'required|string|confirmed',
                'region_id' => 'required|exists:regions,id',
                'category_id' => 'required|exists:categories,id',
                'minimum_order' => 'required|numeric|not_in:0',
                'delivery_charge' => 'nullable|numeric',
                'whats_app' => 'required|numeric|digits:11|unique:restaurants,whats_app',
                'image' => 'required|file|image|mimes:jpg,png',
            ];
        }
    }
}
