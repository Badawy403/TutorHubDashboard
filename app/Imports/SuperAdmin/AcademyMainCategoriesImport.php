<?php

namespace App\Imports\SuperAdmin;

use App\Models\AcademyMainCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class AcademyMainCategoriesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $healer_main_category = AcademyMainCategory::create([
                'name' => $row['name'],
                'description' => $row['description'] ?? null,
                'is_active' => $row['is_active'] ?? 0,
                'image' => $row['image'] ?? null,
                'icon' => $row['icon'] ?? null,
            ]);
            $healer_main_category->slug = Str::slug($row['name'] . ' ' . $healer_main_category->id);
            $healer_main_category->save();
        }
    }
    public function rules(): array
    {
        return [
//            'name' => 'required|string',
//            'description' => 'required|string',
//            'image' => 'nullable|string',
//            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
