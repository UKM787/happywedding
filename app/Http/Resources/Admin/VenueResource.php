<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'nameOfPlace' => $this->nameOfPlace,
            'nameOfHall'=> $this->nameOfHall,
            'city' => $this->city,
            'pincode' => $this->pincode,
            'state' => $this->state,
            'priority' => $this->pincode,
            'reachHere' => $this->reachHere,
            'imageOne' => $this->imageOne,
        ];
    }
}

