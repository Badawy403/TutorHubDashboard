<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitiesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $cities;
    public function __construct($cities)
    {
        $this->cities = $cities;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->cities as $city) {
            $single = [$city->id, $city->state_id, $city->name, $city->description, $city->is_active, date_format($city->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "state_id", "name", "description", "is_active", "created_at"];
    }
}
