<?php

namespace App\Imports\SuperAdmin;

use App\Models\TeacherCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TeacherCategoriesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $teacher_category = TeacherCategory::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],
                'image' => $row['image'] ?? null,
                'parent_category_id' => $row['parent_category_id'] ?? null,

            ]);
            $teacher_category->slug = Str::slug($row['name'] . ' ' . $teacher_category->id);
            $teacher_category->save();
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'is_active' => 'required|numeric|in:0,1',
            'parent_category_id' => 'required|numeric',

        ];
    }
}
