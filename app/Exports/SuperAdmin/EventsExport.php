<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $events;
    public function __construct($events)
    {
        $this->events = $events;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->events as $event) {
            $single = [$event->id, $event->country_id, $event->name, $event->description, $event->is_active, date_format($event->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "country_id", "name", "description", "is_active", "created_at"];
    }
}
