<?php

namespace App\Imports\SuperAdmin;

use App\Models\Archive;
use App\Models\Podcast;
use App\Models\Post;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ArchivesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $archive = Archive::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],

            ]);
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',

            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
