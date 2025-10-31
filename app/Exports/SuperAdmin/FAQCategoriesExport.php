<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FAQCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $faq_categories;
    public function __construct($faq_categories)
    {
        $this->faq_categories = $faq_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->faq_categories as $faq_category) {
            $single = [$faq_category->id, $faq_category->name, $faq_category->description, $faq_category->is_active, $faq_category->slug, date_format($faq_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
