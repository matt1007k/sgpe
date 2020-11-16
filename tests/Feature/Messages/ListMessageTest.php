<?php

namespace Tests\Feature\Messages;

use Tests\TestCase;
use App\Models\Message;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListMessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_simple_message()
    {
        $message = factory(Message::class)->create(['subject' => 'Probando']);

        $response = $this->getJson(route('api.v1.messages.show', $message));

        $response->assertExactJson([
            'data' => [
                'type' => 'messages',
                'id' => (string) $message->getRouteKey(),
                'attributes' => [
                    "to" => $message->to,
                    "subject" => $message->subject,
                    "body" => $message->body,
                    "created_date" => $message->created_at->diffForHumans(),
                    "user" => [
                        'type' => 'users',
                        'id' => (string) $message->user->getRouteKey(),
                        'attributes' => [
                            'name' => $message->user->name,
                            'dni' => $message->user->dni,
                            'email' => $message->user->email,
                            'phone' => $message->user->phone,
                            'status' => $message->user->status,
                        ],
                        'links' => [
                            'self' => route('api.v1.users.show', $message->user)
                        ]
                    ],
                ],
                'links' => [
                    'self' => route('api.v1.messages.show', $message)
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fetch_list_message()
    {
        $message1 = factory(Message::class)->create(['created_at' => now()->days(1)]);
        $message2 = factory(Message::class)->create(['created_at' => now()->days(2)]);
        $message3 = factory(Message::class)->create(['created_at' => now()->days(3)]);

        $url = route('api.v1.messages.index');

        $response = $this->actingAs($this->user)->getJson($url);

        $response->assertJsonFragment([
            'data' => [
                [
                    'type' => 'messages',
                    'id' => (string) $message1->getRouteKey(),
                    'attributes' => [
                        "to" => $message1->to,
                        "subject" => $message1->subject,
                        "body" => $message1->body,
                        "created_date" => $message1->created_at->diffForHumans(),
                        "user" => [
                            'type' => 'users',
                            'id' => (string) $message1->user->getRouteKey(),
                            'attributes' => [
                                'name' => $message1->user->name,
                                'dni' => $message1->user->dni,
                                'email' => $message1->user->email,
                                'phone' => $message1->user->phone,
                                'status' => $message1->user->status,
                            ],
                            'links' => [
                                'self' => route('api.v1.users.show', $message1->user)
                            ]
                        ],
                    ],
                    'links' => [
                        'self' => route('api.v1.messages.show', $message1)
                    ]
                ],
                [
                    'type' => 'messages',
                    'id' => (string) $message2->getRouteKey(),
                    'attributes' => [
                        "to" => $message2->to,
                        "subject" => $message2->subject,
                        "body" => $message2->body,
                        "created_date" => $message2->created_at->diffForHumans(),
                        "user" => [
                            'type' => 'users',
                            'id' => (string) $message2->user->getRouteKey(),
                            'attributes' => [
                                'name' => $message2->user->name,
                                'dni' => $message2->user->dni,
                                'email' => $message2->user->email,
                                'phone' => $message2->user->phone,
                                'status' => $message2->user->status,
                            ],
                            'links' => [
                                'self' => route('api.v1.users.show', $message2->user)
                            ]
                        ],
                    ],
                    'links' => [
                        'self' => route('api.v1.messages.show', $message2)
                    ]
                ],
                [
                    'type' => 'messages',
                    'id' => (string) $message3->getRouteKey(),
                    'attributes' => [
                        "to" => $message3->to,
                        "subject" => $message3->subject,
                        "body" => $message3->body,
                        "created_date" => $message3->created_at->diffForHumans(),
                        "user" => [
                            'type' => 'users',
                            'id' => (string) $message3->user->getRouteKey(),
                            'attributes' => [
                                'name' => $message3->user->name,
                                'dni' => $message3->user->dni,
                                'email' => $message3->user->email,
                                'phone' => $message3->user->phone,
                                'status' => $message3->user->status,
                            ],
                            'links' => [
                                'self' => route('api.v1.users.show', $message3->user)
                            ]
                        ],
                    ],
                    'links' => [
                        'self' => route('api.v1.messages.show', $message3)
                    ]
                ]
            ],
        ]);
    }
}
