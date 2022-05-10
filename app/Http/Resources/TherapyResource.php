<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TherapyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'therapy';
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'type_of_therapy' => $this->resource->type_of_therapy,
            'name_of_therapy' => $this->resource->name_of_therapy,
            'description' => $this->resource->description
        ];
    }
}
