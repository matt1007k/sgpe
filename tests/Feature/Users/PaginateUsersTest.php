<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginateUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_users_paginated()
    {
        $users = factory(User::class)->times(9)->create();

        $url = route('api.v1.users.index', ['page[size]' => 2, 'page[number]' => 3]);

        $response = $this->getJson($url);

        $response->assertJsonCount(2, 'data')
            ->assertDontSee($users[0]->name)
            ->assertDontSee($users[1]->name)
            ->assertDontSee($users[2]->name)
            ->assertSee($users[3]->name)
            ->assertSee($users[4]->name)
            ->assertDontSee($users[5]->name)
            ->assertDontSee($users[6]->name)
            ->assertDontSee($users[7]->name)
            ->assertDontSee($users[8]->name);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);

        $response->assertJsonFragment([
            'first' => route('api.v1.users.index', ['page[size]' => 2, 'page[number]' => 1]),
            'last' => route('api.v1.users.index', ['page[size]' => 2, 'page[number]' => 5]),
            'prev' => route('api.v1.users.index', ['page[size]' => 2, 'page[number]' => 2]),
            'next' => route('api.v1.users.index', ['page[size]' => 2, 'page[number]' => 4]),
        ]);
    }
}
