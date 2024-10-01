<?php

namespace Tests\Feature\Services\Models\Task;

use App\Exceptions\Models\User\UserNotFoundException;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Uuid;

class ListTest extends TaskServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        Task::factory()->count(5)->create();

        $tasksList = $this->taskService->list();

        $this->assertInstanceOf(Collection::class, $tasksList);
        foreach ($tasksList as $task) {
            $this->assertInstanceOf(Task::class, $task);
        }
        $this->assertCount(5, $tasksList);
    }

    public function testSearchByUser()
    {
        $userFoo = User::factory()->create();
        $userBar = User::factory()->create();

        Task::factory(['user_id' => $userFoo->id])->count(5)->create();
        Task::factory(['user_id' => $userBar->id])->count(3)->create();

        $tasksList = $this->taskService->list($userFoo->id);

        $this->assertInstanceOf(Collection::class, $tasksList);
        $this->assertCount(5, $tasksList);
    }

    public function testUserNotFoundException()
    {
        Task::factory()->count(5)->create();
        $randomTaskId = Uuid::uuid4()->toString();
        
        $this->expectException(UserNotFoundException::class);

        $this->taskService->list($randomTaskId);
    }

}
