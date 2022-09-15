<?php

namespace App\Http\Resources\Money;

use Illuminate\Http\Resources\Json\JsonResource;

class VietNameseResource extends JsonResource
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
            'date' => $this->date,
            'type_name' => $this->name,
            'username' => $this->username,
            'user_id' => $this->user_id,
            'order_code' => $this->order_id ? str_pad($this->order_id, 5, '0', STR_PAD_LEFT) : null,
            'order_id' => $this->order_id,
            'packet_id' => $this->packet_id,
            'point_vn' => $this->point_vn,
            'surplus' => $this->surplus,
            'content' => $this->content,
            'created_at' => $this->created_at
        ];
    }
}
