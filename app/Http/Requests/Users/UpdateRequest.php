<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'user_name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'tenant_id' => 'required|exists:tenants,id',
            'password' => 'required|string',
            'profile_image_path' => 'nullable|mimes:jpeg,jpg,png',
            'is_active' => 'nullable|in:1',
        ];
    }
}
