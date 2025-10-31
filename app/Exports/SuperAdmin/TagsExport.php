<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $tags;
    public function __construct($tags)
    {
        $this->tags = $tags;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->tags as $tag) {
            $single = [$tag->id, $tag->name, $tag->description, $tag->is_active, $tag->slug, date_format($tag->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
