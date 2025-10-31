<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FAQSExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $faqs;
    public function __construct($faqs)
    {
        $this->faqs = $faqs;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->faqs as $faq) {
            $single = [$faq->id, $faq->name, $faq->description, $faq->is_active, $faq->slug, date_format($faq->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
