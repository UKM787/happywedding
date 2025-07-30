<?php

namespace App\Http\Resources\Vendor;


use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'fathername' => $this->fathername,
            'mobile' => $this->mobile,
            'mobile1' => $this->mobile1,
            'landline' => $this->landline,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'whatsapp1' => $this->whatsapp1,
            'imageOne' => $this->imageOne,
            'complex' => $this->complex,
            'area' => $this->area,
            'district' => $this->district,
            'zipcode' => $this->zipcode,
            'state' => $this->state,
            'country' => $this->country,
            'vendor_id' => $this->vendor_id,
        ];
    }
}
