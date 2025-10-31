<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlogCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $blog_categories;
    public function __construct($blog_categories)
    {
        $this->blog_categories = $blog_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->blog_categories as $blog_category) {
            $single = [$blog_category->id, $blog_category->name, $blog_category->description, $blog_category->is_active, $blog_category->slug, date_format($blog_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
