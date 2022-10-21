<?php

namespace App\Http\Resources\Packet;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPacketResource extends JsonResource
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
            'warehouse_id' => $this->warehouse_id,
            'weight' => $this->weight,
            'volume' => $this->volume,
            'code' => $this->code,
            'weight_from_volume' => $this->weight_from_volume,
            'unit_price' => $this->unit_price,
            'wood_packing_price' => $this->wood_packing_price,
            'other_price' => $this->other_price,
            'wood_packing' => $this->wood_packing ? true : false,
            'paid' => $this->paid ? true : false,
            'status_id' => $this->status_id,
            'note' => $this->note
        ];
    }
}
