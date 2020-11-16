<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_user()
    {
        $user = factory(User::class)->create();

        $response = $this->getJson(route('api.v1.users.show', $user));

        $response->assertExactJson([
            'data' => [
                'type' => 'users',
                'id' => (string) $user->getRouteKey(),
                'attributes' => [
                    'name' => $user->name,
                    'dni' => $user->dni,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'status' => $user->status,
                    'created_at' => $user->created_at->diffForHumans()
                ],
                'links' => [
                    'self' => route('api.v1.users.show', $user)
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fetch_list_user()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $url = route('api.v1.users.index');

        $response = $this->getJson($url);

        $response->assertJsonFragment([
            'data' => [
                [
                    'type' => 'users',
                    'id' => (string) $this->user->getRouteKey(),
                    'attributes' => [
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'dni' => $this->user->dni,
                        'phone' => $this->user->phone,
                        'status' => $this->user->status,
                        'created_at' => $this->user->created_at->diffForHumans()
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $this->user)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $user1->getRouteKey(),
                    'attributes' => [
                        'name' => $user1->name,
                        'email' => $user1->email,
                        'dni' => $user1->dni,
                        'phone' => $user1->phone,
                        'status' => $user1->status,
                        'created_at' => $user1->created_at->diffForHumans()
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $user1)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $user2->getRouteKey(),
                    'attributes' => [
                        'name' => $user2->name,
                        'email' => $user2->email,
                        'dni' => $user2->dni,
                        'phone' => $user2->phone,
                        'status' => $user2->status,
                        'created_at' => $user2->created_at->diffForHumans()
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $user2)
                    ]
                ],
            ],
        ]);
    }
}
