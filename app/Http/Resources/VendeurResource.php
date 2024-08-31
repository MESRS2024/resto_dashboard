<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendeurResource extends JsonResource
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
            'id' => $this->id,
            'resto_id' => $this->resto_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'password' => $this->password,
            'device_id' => $this->device_id,
            'photo' => $this->photo,
            'ban' => $this->ban,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
