<?php

namespace Tests\Feature\Services\Models\Task;

use App\DTO\Models\TaskDTO;
use App\Exceptions\Models\Task\TaskNotFoundException;
use App\Exceptions\Models\User\UserNotFoundException;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UpdateTest extends TaskServiceTestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        $task = Task::factory()->create();

        $taskDTO = TaskDTO::from($task->toArray());
        $taskDTO->title = $this->faker()->sentence();
        $taskDTO->description = $this->faker()->paragraph();
        $taskDTO->completed = $this->faker()->boolean();

        $taskUpdate = $this->taskService->update($taskDTO);

        $this->assertInstanceOf(Task::class, $taskUpdate);

        $taskDTO->id = $task->id;

        $this->assertDatabaseHas('tasks', $taskDTO->toArray());
    }

    public function testTaskNotFoundException()
    {
        $task = Task::factory()->create();

        $taskDTO = TaskDTO::from($task->toArray());
        do {
            $taskDTO->id = rand();
        } while ($taskDTO->id == $task->id);

        $this->expectException(TaskNotFoundException::class);

        $this->taskService->update($taskDTO);
    }

    public function testUserNotFoundException()
    {
        $task = Task::factory()->create();

        $taskDTO = TaskDTO::from($task->toArray());
        do {
            $taskDTO->user_id = rand();
        } while ($taskDTO->user_id == $task->user_id);

        $this->expectException(UserNotFoundException::class);

        $this->taskService->update($taskDTO);
    }
}
