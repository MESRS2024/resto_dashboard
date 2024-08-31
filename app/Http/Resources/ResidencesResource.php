<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidencesResource extends JsonResource
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
            'code' => $this->code,
            'wilaya' => $this->wilaya,
            'id_residence' => $this->id_residence,
            'denomination_fr' => $this->denomination_fr,
            'denomination_ar' => $this->denomination_ar,
            'dou' => $this->dou,
            'type_residence' => $this->type_residence,
            'id' => $this->id
        ];
    }
}
