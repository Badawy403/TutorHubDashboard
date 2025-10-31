<?php

namespace App\Http\Requests\Teachers\TeacherExperiences;

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
            'company' => 'required|string',
            'from' => 'required',
            'to' => 'required',
            'file' => 'required|mimes:doc,docx,pdf,xls,png,jpeg|max:204800',
        ];
    }
}
