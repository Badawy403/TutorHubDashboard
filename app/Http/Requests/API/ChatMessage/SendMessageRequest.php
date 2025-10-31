<?php

namespace App\Http\Requests\API\ChatMessage;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
            'message' => 'required|string',
            'attachment_file' => 'nullable|mimes:doc,docx,pdf,xls,png,jpeg|max:204800'
        ];
    }
}
