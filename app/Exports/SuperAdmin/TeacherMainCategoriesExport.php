<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherMainCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $teacher_main_categories;
    public function __construct($teacher_main_categories)
    {
        $this->teacher_main_categories = $teacher_main_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->teacher_main_categories as $teacher_main_categories) {
            $single = [$teacher_main_categories->id, $teacher_main_categories->name, $teacher_main_categories->description,$teacher_main_categories->icon,$teacher_main_categories->image, $teacher_main_categories->is_active, $teacher_main_categories->slug, date_format($teacher_main_categories->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description","icon","image", "is_active", "slug", "created_at"];
    }
}
