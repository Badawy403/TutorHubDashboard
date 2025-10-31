<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->file && $this->hasFile('file')) {
            $extension = strtolower($this->file->getClientOriginalExtension());
        } else {
            return [
                'file' => 'required|mimes:xlsx,csv',
            ];
        }
        if (in_array($extension, ['csv', 'xlsx'])) {
            return [
                'file' => 'required',
            ];
        } else {
            return [
                'file' => 'required|mimes:xlsx,csv',
            ];
        }
    }
}
