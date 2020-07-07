<?php

namespace Tests\Feature\People;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterPeopleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_people_by_name()
    {
        factory(Person::class)->create([
            'name' => 'Max'
        ]);

        factory(Person::class)->create([
            'name' => 'Other Name'
        ]);

        $url = route('api.v1.people.index', ['filter[name]' => 'max']);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Max')
            ->assertDontSee('Other Name');
    }

    /** @test */
    public function it_can_filter_people_by_paternal_surname()
    {
        factory(Person::class)->create([
            'paternal_surname' => 'Meza'
        ]);

        factory(Person::class)->create([
            'paternal_surname' => 'Other Surname'
        ]);

        $url = route('api.v1.people.index', ['filter[paternal_surname]' => 'meza']);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Meza')
            ->assertDontSee('Other Surname');
    }

    /** @test */
    public function it_can_filter_people_by_status()
    {
        factory(Person::class)->create([
            'status' => 'cesante'
        ]);

        factory(Person::class)->create([
            'status' => 'activo'
        ]);

        $url = route('api.v1.people.index', ['filter[status]' => 'cesante']);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('cesante')
            ->assertDontSee('activo');
    }

    /** @test */
    public function it_can_filter_people_by_year()
    {
        factory(Person::class)->create([
            'name' => 'Max',
            'created_at' => now()->year(2020)
        ]);

        factory(Person::class)->create([
            'name' => 'Other Name',
            'created_at' => now()->year(2021)
        ]);

        $url = route('api.v1.people.index', ['filter[year]' => 2020]);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Max')
            ->assertDontSee('Other Name');
    }

    /** @test */
    public function it_can_filter_people_by_month()
    {
        factory(Person::class)->create([
            'name' => 'Max',
            'created_at' => now()->month(6)
        ]);

        factory(Person::class)->create([
            'name' => 'Other Name',
            'created_at' => now()->month(5)
        ]);

        $url = route('api.v1.people.index', ['filter[month]' => 6]);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Max')
            ->assertDontSee('Other Name');
    }

    /** @test */
    public function it_cannot_filter_people_by_unknown_filters()
    {
        factory(Person::class)->create();

        $url = route('api.v1.people.index', ['filter[unknown]' => 6]);

        $this->getJson($url)
            ->assertStatus(400);
    }

    /** @test */
    public function it_can_search_people_by_name_and_paternal_surname()
    {
        factory(Person::class)->create([
            'name' => 'Max',
            'paternal_surname' => 'Buscar'
        ]);

        factory(Person::class)->create([
            'name' => 'Buscar Name',
            'paternal_surname' => 'Meza'
        ]);

        factory(Person::class)->create([
            'name' => 'Other Name',
            'paternal_surname' => 'Other'
        ]);

        $url = route('api.v1.people.index', ['filter[search]' => 'buscar']);

        $this->getJson($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('Max')
            ->assertSee('Buscar Name')
            ->assertDontSee('Other Name');
    }

    /** @test */
    public function it_can_search_people_by_name_and_paternal_surname_with_multiple_terms()
    {
        factory(Person::class)->create([
            'name' => 'Max',
            'paternal_surname' => 'Buscar'
        ]);

        factory(Person::class)->create([
            'name' => 'Buscar Name',
            'paternal_surname' => 'Meza'
        ]);

        factory(Person::class)->create([
            'name' => 'Name',
            'paternal_surname' => 'Surname Buscar'
        ]);

        factory(Person::class)->create([
            'name' => 'Other Name',
            'paternal_surname' => 'Other'
        ]);

        $url = route('api.v1.people.index', ['filter[search]' => 'buscar surname']);

        $this->getJson($url)
            ->assertJsonCount(3, 'data')
            ->assertSee('Max')
            ->assertSee('Buscar Name')
            ->assertSee('Name')
            ->assertDontSee('Other Name');
    }
}
