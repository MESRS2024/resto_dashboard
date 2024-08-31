<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DfmResource extends JsonResource
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
            'dou_code' => $this->dou_code,
            'name' => $this->name,
            'code' => $this->code,
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
