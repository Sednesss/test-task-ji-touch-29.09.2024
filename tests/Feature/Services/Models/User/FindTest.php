<?php

namespace Tests\Feature\Services\Models\User;

use App\Exceptions\Models\User\UserNotFoundException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FindTest extends UserServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        $user = User::factory()->create();

        $userFind = $this->userService->find($user->id);

        $this->assertInstanceOf(User::class, $userFind);
        $this->assertEquals($user->toArray(), $userFind->toArray());
    }

    public function testUserNotFoundException()
    {
        $user = User::factory()->create();

        do {
            $randomId = rand();
        } while ($randomId == $user->id);

        $this->expectException(UserNotFoundException::class);

        $this->userService->find($randomId);
    }
}
