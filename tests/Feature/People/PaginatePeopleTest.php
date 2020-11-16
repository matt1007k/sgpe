<?php

namespace Tests\Feature\People;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaginatePeopleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_people_paginated()
    {
        $people = factory(Person::class)->times(10)->create();

        $url = route('api.v1.people.index', ['page[size]' => 2, 'page[number]' => 3]);

        $response = $this->getJson($url);

        $response->assertJsonCount(2, 'data')
            ->assertDontSee($people[0]->name)
            ->assertDontSee($people[1]->name)
            ->assertDontSee($people[2]->name)
            ->assertDontSee($people[3]->name)
            ->assertSee($people[4]->name)
            ->assertSee($people[5]->name)
            ->assertDontSee($people[6]->name)
            ->assertDontSee($people[7]->name)
            ->assertDontSee($people[8]->name)
            ->assertDontSee($people[9]->name);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);

        $response->assertJsonFragment([
            'first' => route('api.v1.people.index', ['page[size]' => 2, 'page[number]' => 1]),
            'last' => route('api.v1.people.index', ['page[size]' => 2, 'page[number]' => 5]),
            'prev' => route('api.v1.people.index', ['page[size]' => 2, 'page[number]' => 2]),
            'next' => route('api.v1.people.index', ['page[size]' => 2, 'page[number]' => 4]),
        ]);
    }
}
