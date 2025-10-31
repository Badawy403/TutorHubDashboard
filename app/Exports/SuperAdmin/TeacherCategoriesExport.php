<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $teacher_categories;
    public function __construct($teacher_categories)
    {
        $this->teacher_categories = $teacher_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->teacher_categories as $teacher_category) {
            $single = [$teacher_category->id, $teacher_category->name, $teacher_category->description, $teacher_category->is_active, $teacher_category->slug, date_format($teacher_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
