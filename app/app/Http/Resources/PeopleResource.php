<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
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
            'personid' => $this->person_id,
            'personname' => $this->name,
            'phones' => PersonPhoneResource::collection($this->phones)
        ];
    }
}
