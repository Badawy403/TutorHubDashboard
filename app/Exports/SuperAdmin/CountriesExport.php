<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CountriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $countries;
    public function __construct($countries)
    {
        $this->countries = $countries;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->countries as $country) {
            $single = [$country->id, $country->name, $country->description, $country->country_code, $country->iso_code, $country->is_active, date_format($country->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "country_code", "iso_code", "is_active", "created_at"];
    }
}
