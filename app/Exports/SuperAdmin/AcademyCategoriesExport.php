<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcademyCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $academy_categories;
    public function __construct($academy_categories)
    {
        $this->academy_categories = $academy_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->academy_categories as $academy_category) {
            $single = [$academy_category->id, $academy_category->name, $academy_category->description, $academy_category->is_active, $academy_category->slug, date_format($academy_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
