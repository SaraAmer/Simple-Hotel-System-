<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return[   
        // 'floor_id'=>$this->floor_id,
        // 'capacity'=>$this->capacity,
        // 'price_inCents'=>$this->price_inCents,
        // 'floor_name'=>$room->floors ? $room->floors->name : 'floor name',
        // ];
    }
}
