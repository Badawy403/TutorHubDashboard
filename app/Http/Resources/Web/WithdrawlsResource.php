<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawlsResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                "id" =>  $this->id,
                "amount" =>  $this->amount,
                "account_holder" =>  $this->account_holder,
                "account_number" =>  $this->account_number,
                "bank" =>  $this->bank,
                "additional_note" =>  $this->additional_note,
                "status" =>  $this->status,
                "rejected_reason" =>  $this->rejected_reason,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
