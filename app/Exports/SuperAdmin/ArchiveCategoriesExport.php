<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArchiveCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $archive_categories;
    public function __construct($archive_categories)
    {
        $this->archive_categories = $archive_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->archive_categories as $archive_category) {
            $single = [$archive_category->id, $archive_category->name, $archive_category->description, $archive_category->is_active, $archive_category->slug, date_format($archive_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
