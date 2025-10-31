<?php

namespace App\Http\Requests\API\Teachers\TeacherPodcasts;

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
        $rules = [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'link_type' => 'required|in:external,internal',
            'file_type' => 'required|in:audio,video',
        ];
        if($this->link_type == 'external'){
            $rules['file_url'] =  'required|url';
        }
        if($this->link_type == 'internal' && $this->file_type == 'audio'){
            $rules['audio'] =  'required|audio';
        }
        if($this->link_type == 'internal' && $this->file_type == 'video'){
            $rules['video'] =  'required|video';
        }
        return $rules;
    }
}
