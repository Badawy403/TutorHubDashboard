<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AcademiesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $academies;
    public function __construct($academies)
    {
        $this->academies = $academies;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->academies as $academy) {
            $single = [$academy->id, $academy->name, $academy->description, $academy->is_active, date_format($academy->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
