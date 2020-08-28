<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_users_by_verified()
    {
        factory(User::class)->create([
            'name' => 'Max',
            'status' => 'verified'
        ]);

        factory(User::class)->create([
            'name' => 'Other Name',
            'status' => 'unverified'
        ]);

        $url = route('api.v1.users.index', ['filter[status]' => 'verified']);

        $this->getJson($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('Max')
            ->assertDontSee('Other Name');
    }

    /** @test */
    public function it_can_filter_users_by_unverified()
    {
        factory(User::class)->create([
            'name' => 'Max',
            'status' => 'verified'
        ]);

        factory(User::class)->create([
            'name' => 'Other Name',
            'status' => 'unverified'
        ]);

        $url = route('api.v1.users.index', ['filter[status]' => 'unverified']);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Other Name')
            ->assertDontSee('Max');
    }

    /** @test */
    public function it_cannot_filter_users_by_unknown_filters()
    {
        factory(User::class)->create();

        $url = route('api.v1.users.index', ['filter[unknown]' => 6]);

        $this->getJson($url)
            ->assertStatus(400);
    }

    /** @test */
    public function it_can_search_users_by_name_and_dni()
    {
        factory(User::class)->create([
            'name' => 'Max',
            'dni' => '12345678'
        ]);

        factory(User::class)->create([
            'name' => 'Buscar Name',
            'dni' => '111111111'
        ]);

        factory(User::class)->create([
            'name' => 'Other Name',
            'dni' => '22222222'
        ]);

        $url = route('api.v1.users.index', ['filter[search]' => '1']);

        $this->getJson($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('Max')
            ->assertSee('Buscar Name')
            ->assertDontSee('Other Name');
    }

    /** @test */
    public function it_can_search_users_by_name_and_dni_with_multiple_terms()
    {
        factory(User::class)->create([
            'name' => 'Max',
            'dni' => '12345678'
        ]);

        factory(User::class)->create([
            'name' => 'Buscar Name',
            'dni' => '111111111'
        ]);

        factory(User::class)->create([
            'name' => 'Other Name',
            'dni' => '22222222'
        ]);

        $url = route('api.v1.users.index', ['filter[search]' => 'max 111']);

        $this->getJson($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('Max')
            ->assertSee('Buscar Name')
            ->assertDontSee('Other Name');
    }
}
