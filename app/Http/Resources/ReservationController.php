<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationController extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'cient id' =>$this->client_id,
            'accompanynumber' =>$this->accompany_number,
            'roomnumber' =>$this->room_number,
            'paidprice' =>$this->{'paid price'},
            // 'clientname'=>[
            //     $this->client->name
            // ],
            
        ];
    }
}
