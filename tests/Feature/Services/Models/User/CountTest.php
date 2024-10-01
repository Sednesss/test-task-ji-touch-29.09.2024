<?php

namespace Tests\Feature\Services\Models\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountTest extends UserServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        User::factory()->count(5)->create();

        $usersCount = $this->userService->count();

        $this->assertIsInt($usersCount);
        $this->assertEquals($usersCount, 5);
    }
}
