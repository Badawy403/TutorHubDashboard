<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BankAccountsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $bank_accounts;
    public function __construct($bank_accounts)
    {
        $this->bank_accounts = $bank_accounts;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->bank_accounts as $bank_account) {
            $single = [$bank_account->id,$bank_account->name,$bank_account->account_holder_name, $bank_account->account_number, $bank_account->iban_number, $bank_account->bic_swift,  $bank_account->is_active,];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id","name", "account_holder_name","account_number", "iban_number","bic_swift", "is_active"];
    }
}
