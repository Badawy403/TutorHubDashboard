<?php

namespace App\Imports\SuperAdmin;

use App\Models\Language;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class LanguagesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $language = Language::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],
                'code' => $row['code'],
                'is_default' => $row['is_default'],
                'image' => $row['image'] ?? null,
            ]);
            if ($language->is_default) {
                Language::where('id', '!=', $language->id)->update(['is_default' => 1]);
            }
            $language->save();
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'code' => 'required|string',
            'is_active' => 'required|numeric|in:0,1',
            'is_default' => 'required|numeric|in:0,1',
        ];
    }
}
