<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PodcastsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $podcasts;
    public function __construct($podcasts)
    {
        $this->podcasts = $podcasts;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->podcasts as $podcast) {
            $single = [$podcast->id, $podcast->name, $podcast->description, $podcast->is_active, date_format($podcast->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
