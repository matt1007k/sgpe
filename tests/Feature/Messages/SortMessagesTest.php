<?php

namespace Tests\Feature\Messages;

use Tests\TestCase;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SortMessagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_messages_by_subject_asc()
    {
        factory(Message::class)->create(['subject' => 'C Name']);
        factory(Message::class)->create(['subject' => 'B Name']);
        factory(Message::class)->create(['subject' => 'A Name']);

        $url = route('api.v1.messages.index', ['sort' => 'subject']);

        $response = $this->actingAs($this->user)->getJson($url);

        $response->assertSeeInOrder([
            'A Name',
            'B Name',
            'C Name',
        ]);
    }

    /** @test */
    public function it_can_sort_messages_by_subject_desc()
    {
        factory(Message::class)->create(['subject' => 'C Name']);
        factory(Message::class)->create(['subject' => 'A Name']);
        factory(Message::class)->create(['subject' => 'B Name']);

        $url = route('api.v1.messages.index', ['sort' => '-subject']);

        $response = $this->actingAs($this->user)->getJson($url);

        $response->assertSeeInOrder([
            'C Name',
            'B Name',
            'A Name',
        ]);
    }


    /** @test */
    public function it_cannot_sort_messages_by_unknowns_fields()
    {
        factory(Message::class)->times(3)->create();

        $url = route('api.v1.messages.index', ['sort' => 'unknowns']);

        $response = $this->actingAs($this->user)->getJson($url);

        $response->assertStatus(400);
    }
}
