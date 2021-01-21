<?php

namespace App\Http\Resources;

use App\Models\Item;
use App\Models\ShipOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'orderid' => $this->order_id,
            'items' => ItemResource::collection($this->items),
            'shipto' => [
                'name' => $this->name,
                'address' => $this->address,
                'city' => $this->city,
                'country' => $this->country,
            ]
        ];
    }
}
