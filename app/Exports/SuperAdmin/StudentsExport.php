<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $students;
    public function __construct($students)
    {
        $this->students = $students;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->students as $student) {
            $single = [$student->id, $student->name, $student->description, $student->is_active, date_format($student->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
