<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BroadcastsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $broadcasts;
    public function __construct($broadcasts)
    {
        $this->broadcasts = $broadcasts;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->broadcasts as $broadcast) {
            $single = [$broadcast->id, $broadcast->name, $broadcast->description, $broadcast->is_active, date_format($broadcast->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
