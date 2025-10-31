<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BroadcastCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $broadcast_categories;
    public function __construct($broadcast_categories)
    {
        $this->broadcast_categories = $broadcast_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->broadcast_categories as $broadcast_category) {
            $single = [$broadcast_category->id, $broadcast_category->name, $broadcast_category->description, $broadcast_category->is_active,  date_format($broadcast_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
