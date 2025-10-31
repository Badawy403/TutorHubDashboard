<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PricingPlansExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $pricing_plans;
    public function __construct($pricing_plans)
    {
        $this->pricing_plans = $pricing_plans;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->pricing_plans as $pricing_plan) {
            $single = [$pricing_plan->id, $pricing_plan->name, $pricing_plan->description, $pricing_plan->is_active, $pricing_plan->color, date_format($pricing_plan->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "color", "created_at"];
    }
}
