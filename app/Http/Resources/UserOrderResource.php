<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_code' => $this->id,
            'status_name' => $this->status_name,
            'deposit_amount' => abs($this->deposit_amount),
            'total_price' => ceil($this->total_price),
            'remain_amount' => round(ceil($this->total_price) + $this->deposit_amount, 2),
        ];
    }
}
