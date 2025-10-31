<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LanguagesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $languages;
    public function __construct($languages)
    {
        $this->languages = $languages;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->languages as $language) {
            $single = [$language->id, $language->name, $language->description, $language->is_active, $language->is_default, $language->code, date_format($language->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "is_default", "code", "created_at"];
    }
}
