<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestoResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'password' => $this->password,
            'is_active' => $this->is_active,
            'breakfast' => $this->breakfast,
            'lunch' => $this->lunch,
            'dinner' => $this->dinner,
            'b_start' => $this->b_start,
            'b_end' => $this->b_end,
            'l_start' => $this->l_start,
            'l_end' => $this->l_end,
            'd_start' => $this->d_start,
            'd_end' => $this->d_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'dou_code' => $this->dou_code,
            'resto_type' => $this->resto_type,
            'id_progres' => $this->id_progres
        ];
    }
}
