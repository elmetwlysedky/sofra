<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $roleId = $this->route('role');
        return [
                'name'=> 'required','string','max:255',Rule::unique('roles', 'name')->ignore($roleId),
                'permission_id' => 'nullable|exists:permissions,id'
        ];
    }
}
