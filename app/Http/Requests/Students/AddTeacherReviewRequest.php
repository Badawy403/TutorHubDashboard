<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class AddTeacherReviewRequest extends FormRequest
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
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user= auth()->user();
        $student = $user->student;
        return [
            'rating' => 'required|numeric|max:5',
            'experience' => 'required|numeric|max:5',
            'service' => 'required|numeric|max:5',
            'communication' => 'required|numeric|max:5',
            'comment' => 'required|string',
            'teacher_id' => 'required',
        ];
    }
}
