<?php

namespace App\Imports\SuperAdmin;

use App\Models\Podcast;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class PodcastsImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $podcast = Podcast::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],
            ]);
        }
    }
    public function rules(): array
    {
        return [

        ];
    }
}
