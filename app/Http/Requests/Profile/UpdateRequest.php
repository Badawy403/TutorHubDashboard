<?php

namespace App\Http\Requests\Profile;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function messages()
    {
        return [];
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'profile_image_path' => 'nullable|mimes:jpeg,jpg,png',
            //  'is_active' => 'nullable|in:1',
            // 'images' => 'required|image'
            //  'images.*' => 'required|image|max:2000',

        ];
    }
}
