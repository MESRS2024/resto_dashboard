<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class clientsResource extends JsonResource
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
            'type' => $this->type,
            'name' => $this->name,
            'card' => $this->card,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'code' => $this->code,
            'duplicate' => $this->duplicate,
            'progres_id' => $this->progres_id
        ];
    }
}
