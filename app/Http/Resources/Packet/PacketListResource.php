<?php

namespace App\Http\Resources\Packet;

use Illuminate\Http\Resources\Json\JsonResource;

class PacketListResource extends JsonResource
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
            'code' => $this->code,
            'wood_packing' => $this->wood_packing,
            'note' => $this->note,
            'total_price' => $this->total_price,
            'status_id' => $this->status_id,
            'status_name' => config("const.admin_packet_status.$this->status_id"),
            'tracking_status_name' => $this->tracking_status_name,
            'paid' => $this->paid,
            'warehouse_id' => $this->warehouse_id
        ];
    }
}
