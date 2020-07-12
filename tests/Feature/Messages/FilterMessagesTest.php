<?php

namespace Tests\Feature\Messages;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterMessagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_messages_recivied_by_me()
    {
        factory(Message::class)->create([
            'to' => $this->user->email,
            'subject' => 'Recibido'
        ]);

        factory(Message::class)->create([
            'subject' => 'Other message',
            'user_id' => $this->user->id
        ]);

        $url = route('api.v1.messages.index', ['filter[send]' => 'me']);

        $this->actingAs($this->user)->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Recibido')
            ->assertDontSee('Other message');
    }

    /** @test */
    public function it_can_filter_messages_sended_by_me()
    {
        factory(Message::class)->create([
            'subject' => 'Enviado por mi',
            'user_id' => $this->user->id
        ]);

        factory(Message::class)->create([
            'to' => $this->user->email,
            'subject' => 'Other subject'
        ]);

        $url = route('api.v1.messages.index', ['filter[send]' => 'send']);

        $this->actingAs($this->user)->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Enviado por mi')
            ->assertDontSee('Other subject');
    }
}
