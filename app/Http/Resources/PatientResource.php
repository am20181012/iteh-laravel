<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'patient';

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->resource->id,
            'card_num' => $this->resource->card_num,
            'name' => $this->resource->name,
            'date_of_brith' => $this->resource->date_of_birth,
            'gender' => $this->resource->gender,
            'adress' => $this->resource->adress,
            'email' => $this->resource->email
        ];
    }
}
