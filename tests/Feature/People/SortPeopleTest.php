<?php

namespace Tests\Feature\People;

use Tests\TestCase;
use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SortPeopleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_people_by_name_asc()
    {
        factory(Person::class)->create(['name' => 'C Name']);
        factory(Person::class)->create(['name' => 'B Name']);
        factory(Person::class)->create(['name' => 'A Name']);

        $url = route('api.v1.people.index', ['sort' => 'name']);

        $response = $this->getJson($url);

        $response->assertSeeInOrder([
            'A Name',
            'B Name',
            'C Name',
        ]);
    }

    /** @test */
    public function it_can_sort_people_by_name_desc()
    {
        factory(Person::class)->create(['name' => 'C Name']);
        factory(Person::class)->create(['name' => 'A Name']);
        factory(Person::class)->create(['name' => 'B Name']);

        $url = route('api.v1.people.index', ['sort' => '-name']);

        $response = $this->getJson($url);

        $response->assertSeeInOrder([
            'C Name',
            'B Name',
            'A Name',
        ]);
    }

    /** @test */
    public function it_can_sort_people_by_name_and_paternal_surname()
    {
        factory(Person::class)->create([
            'name' => 'C Name',
            'paternal_surname' => 'C Surname',
        ]);
        factory(Person::class)->create([
            'name' => 'A Name',
            'paternal_surname' => 'D Surname',
        ]);
        factory(Person::class)->create([
            'name' => 'B Name',
            'paternal_surname' => 'B Surname',
        ]);


        // \DB::listen(function ($db) {
        //     dump($db->sql);
        // });

        $url = route('api.v1.people.index', ['sort' => 'name,-paternal_surname']);

        $response = $this->getJson($url);

        $response->assertSeeInOrder([
            'A Name',
            'B Name',
            'C Name',
        ]);

        $url = route('api.v1.people.index', ['sort' => 'paternal_surname,-name']);

        $response = $this->getJson($url);

        $response->assertSeeInOrder([
            'B Surname',
            'C Surname',
            'D Surname',
        ]);
    }

    /** @test */
    public function it_cannot_sort_people_by_unknowns_fields()
    {
        factory(Person::class)->times(3)->create();

        $url = route('api.v1.people.index', ['sort' => 'unknowns']);

        $response = $this->getJson($url);

        $response->assertStatus(400);
    }
}
