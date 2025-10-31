<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return string[]
     */
    public function messages()
    {
        return [
            'name' => 'Name field is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => 'required|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'tenant_id' => 'required|exists:tenants,id',
            'role_code' => 'required|exists:roles,role_code',
            'permissions' => 'nullable|array',
            'password' => 'required|string',
            'profile_image_path' => 'nullable|mimes:jpeg,jpg,png',
            'is_active' => 'nullable|in:1',
        ];
    }
}
