<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'type' => 'people',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'paternal_surname' => $this->resource->paternal_surname,
                'maternal_surname' => $this->resource->maternal_surname,
                'dni' => $this->resource->dni,
                'modular_code' => $this->resource->modular_code,
                'status' => $this->resource->status
            ],
            'links' => [
                'self' => route('api.v1.people.show', $this->resource)
            ]
        ];
    }
}
