<?php

namespace Tests\Feature\Services\Models\User;

use App\Services\Models\UserService;
use Tests\TestCase;

class UserServiceTestCase extends TestCase
{
    protected UserService $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = resolve(UserService::class);
    }
}
