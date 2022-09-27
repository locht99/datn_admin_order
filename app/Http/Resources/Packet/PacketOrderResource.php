<?php

namespace App\Http\Resources\Packet;

use Illuminate\Http\Resources\Json\JsonResource;

class PacketOrderResource extends JsonResource
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
            'code' => $this->code ? $this->code : $this->waybill_code,
            'order_id' => ($this->order_id ? $this->order_id : ""),
            'order_code' => ($this->order_id ? str_pad($this->order_id, 5, '0', STR_PAD_LEFT) : ""),
            'id' => isset($this->id) ? $this->id : '' 
        ];
    }
}
