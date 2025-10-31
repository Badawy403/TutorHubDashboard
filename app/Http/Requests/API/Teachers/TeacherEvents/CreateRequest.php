<?php

namespace App\Http\Requests\API\Teachers\TeacherEvents;

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
            'is_active' => 'nullable|in:0,1',
            'tag_ids' => 'nullable|array',
            'sponsor' => 'nullable|string',
            'starts_at' => 'nullable|string',
            'ends_at' => 'nullable|string',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpeg,webp|max:204800',
        ];
    }
}
