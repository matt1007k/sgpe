<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SortUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sort_users_by_created_at_asc()
    {
        $user2 = factory(User::class)->create(['created_at' => now()->days(1)]);
        $user3 = factory(User::class)->create(['created_at' => now()->days(2)]);
        $user4 = factory(User::class)->create(['created_at' => now()->days(3)]);

        $url = route('api.v1.users.index', ['sort' => 'created_at']);

        $response = $this->getJson($url)->dump();

        $response->assertSeeInOrder([
            $this->user->name,
            $user2->name,
            $user3->name,
            $user4->name,
        ]);
    }

    /** @test */
    public function it_can_sort_users_by_created_at_desc()
    {
        $user2 = factory(User::class)->create(['created_at' => now()->days(1)]);
        $user3 = factory(User::class)->create(['created_at' => now()->days(2)]);
        $user4 = factory(User::class)->create(['created_at' => now()->days(3)]);

        $url = route('api.v1.users.index', ['sort' => '-created_at']);

        $response = $this->getJson($url);

        $response->assertSeeInOrder([
            $this->user->name,
            $user2->name,
            $user3->name,
            $user4->name,
        ]);
    }

    /** @test */
    public function it_cannot_sort_users_by_unknowns_fields()
    {
        factory(User::class)->times(3)->create();

        $url = route('api.v1.users.index', ['sort' => 'unknowns']);

        $response = $this->getJson($url);

        $response->assertStatus(400);
    }
}
