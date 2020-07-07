<?php

namespace Tests\Feature\People;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListPersonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_single_person()
    {
        $this->withoutExceptionHandling();

        $person = factory(Person::class)->create();

        $response = $this->getJson(route('api.v1.people.show', $person));

        $response->assertExactJson([
            'data' => [
                'type' => 'people',
                'id' => (string) $person->getRouteKey(),
                'attributes' => [
                    'name' => $person->name,
                    'paternal_surname' => $person->paternal_surname,
                    'maternal_surname' => $person->maternal_surname,
                    'dni' => $person->dni,
                    'modular_code' => $person->modular_code,
                    'status' => $person->status
                ],
                'links' => [
                    'self' => route('api.v1.people.show', $person)
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fetch_list_person()
    {
        $people = factory(Person::class)->times(3)->create();

        $url = route('api.v1.people.index');

        $response = $this->getJson($url);

        $response->assertJsonFragment([
            'data' => [
                [
                    'type' => 'people',
                    'id' => (string) $people[0]->getRouteKey(),
                    'attributes' => [
                        'name' => $people[0]->name,
                        'paternal_surname' => $people[0]->paternal_surname,
                        'maternal_surname' => $people[0]->maternal_surname,
                        'dni' => $people[0]->dni,
                        'modular_code' => $people[0]->modular_code,
                        'status' => $people[0]->status
                    ],
                    'links' => [
                        'self' => route('api.v1.people.show', $people[0])
                    ]
                ],
                [
                    'type' => 'people',
                    'id' => (string) $people[1]->getRouteKey(),
                    'attributes' => [
                        'name' => $people[1]->name,
                        'paternal_surname' => $people[1]->paternal_surname,
                        'maternal_surname' => $people[1]->maternal_surname,
                        'dni' => $people[1]->dni,
                        'modular_code' => $people[1]->modular_code,
                        'status' => $people[1]->status
                    ],
                    'links' => [
                        'self' => route('api.v1.people.show', $people[1])
                    ]
                ],
                [
                    'type' => 'people',
                    'id' => (string) $people[2]->getRouteKey(),
                    'attributes' => [
                        'name' => $people[2]->name,
                        'paternal_surname' => $people[2]->paternal_surname,
                        'maternal_surname' => $people[2]->maternal_surname,
                        'dni' => $people[2]->dni,
                        'modular_code' => $people[2]->modular_code,
                        'status' => $people[2]->status
                    ],
                    'links' => [
                        'self' => route('api.v1.people.show', $people[2])
                    ]
                ]
            ],
        ]);
    }
}
