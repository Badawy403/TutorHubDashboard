<?php

namespace App\Http\Requests\API\Teachers\TeacherBroadcasts;

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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:doc,docx,pdf,xls,png,jpeg|max:204800',
            'tag_ids' => 'nullable|array',
            'is_active' => 'required|in:0,1'
        ];
    }
}
