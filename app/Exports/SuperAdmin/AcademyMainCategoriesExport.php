<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcademyMainCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $academy_main_categories;
    public function __construct($academy_main_categories)
    {
        $this->academy_main_categories = $academy_main_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->academy_main_categories as $academy_main_categories) {
            $single = [$academy_main_categories->id, $academy_main_categories->name, $academy_main_categories->description,$academy_main_categories->icon,$academy_main_categories->image, $academy_main_categories->is_active, $academy_main_categories->slug, date_format($academy_main_categories->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description","icon","image", "is_active", "slug", "created_at"];
    }
}
