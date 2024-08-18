<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'whats_app' => 'nullable|string|max:255',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'link_app_store' => 'nullable|url',
            'link_google_play' => 'nullable|url',
        ];
    }
}
