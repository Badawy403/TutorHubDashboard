<?php

namespace App\Http\Requests\API\Teachers\TeacherPosts;

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
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'image' => 'nullable|mimes:png,jpeg,webp|max:204800',
        ];
    }
}
