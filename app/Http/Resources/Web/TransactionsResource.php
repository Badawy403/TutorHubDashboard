<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
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
                "payable_type" =>  $this->payable_type,
                "payable_id" =>  $this->payable_id,
                "wallet_id" =>  $this->wallet_id,
                "type" =>  $this->type,
                "amount" =>  $this->amount,
                "confirmed" =>  $this->confirmed,
                "uuid" =>  $this->uuid,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
