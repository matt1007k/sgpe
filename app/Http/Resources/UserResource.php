<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'users',
            'id' => (string) $this->getRouteKey(),
            'attributes' => [
                'name' => $this->name,
                'dni' => $this->dni,
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status,
                'file' => $this->pathFile(),
                'created_at' => $this->created_at->diffForHumans(),
            ],
            'links' => [
                'self' => route('api.v1.users.show', $this)
            ]
        ];
    }
}
