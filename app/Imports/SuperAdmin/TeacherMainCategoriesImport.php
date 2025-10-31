<?php

namespace App\Imports\SuperAdmin;

use App\Models\TeacherMainCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TeacherMainCategoriesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $teacher_main_category = TeacherMainCategory::create([
                'name' => $row['name'],
                'description' => $row['description'] ?? null,
                'is_active' => $row['is_active'] ?? 0,
                'image' => $row['image'] ?? null,
                'icon' => $row['icon'] ?? null,
            ]);
            $teacher_main_category->slug = Str::slug($row['name'] . ' ' . $teacher_main_category->id);
            $teacher_main_category->save();
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
