<?php

namespace App\Imports\SuperAdmin;

use App\Models\BankAccount;
use App\Models\Event;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class BankAccountsImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $bank_account = BankAccount::create([
                'name' => $row['name'],
                'account_holder_name' => $row['account_holder_name'],
                'account_number' => $row['account_number'],
                'iban_number' => $row['iban_number'],
                'bic_swift' => $row['bic_swift'],
                'is_active' => $row['is_active'],
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
