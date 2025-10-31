<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeachersExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $teachers;
    public function __construct($teachers)
    {
        $this->teachers = $teachers;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->teachers as $teacher) {
            $single = [$teacher->id, $teacher->name, $teacher->description, $teacher->is_active, date_format($teacher->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
