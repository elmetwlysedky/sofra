<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                'phone' => 'required|numeric|digits:11|unique:clients,phone,' . $this->id,
                'email' => 'required|string|email|unique:clients,email,' . $this->id,
                'password' => 'nullable|string|confirmed',
                'region_id' => 'required|exists:regions,id',
            ];
        } else {
            return [
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits:11|unique:clients,phone',
                'email' => 'required|string|email|unique:clients,email',
                'password' => 'required|string|confirmed',
                'region_id' => 'required|exists:regions,id',
            ];
        }
    }
}
