<?php

namespace App\Http\Requests\API\Students;

use Illuminate\Foundation\Http\FormRequest;

class BookedServiceRequest extends FormRequest
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
            'question' => 'nullable|string',
            'date' => 'nullable|date',
            'service_id' => 'required|exists:services,id'
            //'stripe_token' => 'required|string'
        ];
    }
}
