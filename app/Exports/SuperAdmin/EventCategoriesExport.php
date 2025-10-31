<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $event_categories;
    public function __construct($event_categories)
    {
        $this->event_categories = $event_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->event_categories as $event_category) {
            $single = [$event_category->id, $event_category->name, $event_category->description, $event_category->is_active, $event_category->slug, date_format($event_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
