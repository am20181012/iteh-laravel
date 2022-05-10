<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiagnosisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'diagnosis';
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'date_of_diagnosis' => $this->resource->date_of_diagnosis,
            'latin_name' => $this->resource->latin_name,
            'description' => $this->resource->description,
            'cause' => $this->resource->cause,
            'hospitalization' => $this->resource->hospitalization,
            'note' => $this->resource->note,
            'patient' => new PatientResource($this->resource->patient),
            'user' => new UserResource($this->resource->user)
        ];
    }
}
