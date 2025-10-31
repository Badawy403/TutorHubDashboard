<?php

namespace App\Http\Requests\Academies\AcademyTeachers;

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
            'speciality' => 'required|string',
            'experience' => 'required',
            'is_active' => 'nullable|boolean'
        ];
    }
}
