<?php

namespace App\Http\Requests\SuperAdmin\Students;

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
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|in:1',
            'user_name' => 'required|alpha_dash|unique:students,user_name,'.$this->student->id,
        ];
    }
}
