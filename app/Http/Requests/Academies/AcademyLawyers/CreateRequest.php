<?php

namespace App\Http\Requests\Academies\AcademyTeachers;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'speciality' => 'required|string',
            'experience' => 'required',
            'email' => 'required|string',
            'user_name' => 'required|alpha_dash|max:55|unique:teachers,user_name',
            'password' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ];
    }
}
