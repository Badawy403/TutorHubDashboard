<?php

namespace App\Http\Requests\Users\Profile;

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
            'user_name' => 'required|unique:users,user_name,'.$this->user->id,
            'residence' => 'nullable|string',
            'gender' => 'required|string',
            'age' => 'required|numeric|gt:18',
            'email' => 'required|email|unique:users,email,'.$this->user->id
        ];
    }
}
