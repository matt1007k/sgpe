<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'type' => 'messages',
            'id' => (string) $this->getRouteKey(),
            'attributes' => [
                "to" => $this->to,
                "subject" => $this->subject,
                "body" => $this->body,
                "created_date" => $this->created_at->diffForHumans(),
                "user" => UserResource::make($this->user),
            ],
            'links' => [
                'self' => route('api.v1.messages.show', $this)
            ]
        ];
    }
}
