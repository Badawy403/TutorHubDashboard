<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestimonialsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $testimonials;
    public function __construct($testimonials)
    {
        $this->testimonials = $testimonials;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->testimonials as $testimonial) {
            $single = [$testimonial->id, $testimonial->name, $testimonial->description, $testimonial->is_active, $testimonial->slug, date_format($testimonial->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
