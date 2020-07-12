<?php

namespace Tests\Feature\Messages;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginateMessagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_messages_paginated()
    {
        $messages = factory(Message::class)->times(10)->create();

        $url = route('api.v1.messages.index', ['page[size]' => 2, 'page[number]' => 3]);

        $response = $this->actingAs($this->user)->getJson($url);

        $response->assertJsonCount(2, 'data')
            ->assertDontSee($messages[0]->subject)
            ->assertDontSee($messages[1]->subject)
            ->assertDontSee($messages[2]->subject)
            ->assertDontSee($messages[3]->subject)
            ->assertSee($messages[4]->subject)
            ->assertSee($messages[5]->subject)
            ->assertDontSee($messages[6]->subject)
            ->assertDontSee($messages[7]->subject)
            ->assertDontSee($messages[8]->subject)
            ->assertDontSee($messages[9]->subject);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);

        $response->assertJsonFragment([
            'first' => route('api.v1.messages.index', ['page[size]' => 2, 'page[number]' => 1]),
            'last' => route('api.v1.messages.index', ['page[size]' => 2, 'page[number]' => 5]),
            'prev' => route('api.v1.messages.index', ['page[size]' => 2, 'page[number]' => 2]),
            'next' => route('api.v1.messages.index', ['page[size]' => 2, 'page[number]' => 4]),
        ]);
    }
}
