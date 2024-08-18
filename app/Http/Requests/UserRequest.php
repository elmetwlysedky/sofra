<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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


        $rules = [
            'name' => ['required','string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->id,
            'password' => ['nullable','min:8', 'confirmed'],
        ];

        if ($this->isMethod('post')) {
            // قواعد إضافية لعملية الإنشاء
            $rules['password'] = 'required|min:8|confirmed';
            $rules['email'] = 'required|string|email|max:255|unique:users,email';

        }
        return $rules;
    }
}
