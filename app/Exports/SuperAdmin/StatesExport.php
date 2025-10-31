<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $states;
    public function __construct($states)
    {
        $this->states = $states;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->states as $state) {
            $single = [$state->id, $state->country_id, $state->name, $state->description, $state->is_active, date_format($state->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "country_id", "name", "description", "is_active", "created_at"];
    }
}
