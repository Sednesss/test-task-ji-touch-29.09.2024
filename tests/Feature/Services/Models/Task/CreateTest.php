<?php

namespace Tests\Feature\Services\Models\Task;

use App\DTO\Models\TaskDTO;
use App\Exceptions\Models\Task\TaskAlreadyExistsException;
use App\Exceptions\Models\User\UserNotFoundException;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TaskServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        $task = Task::factory()->make();

        $taskDTO = TaskDTO::from($task->toArray());
        $taskDTO->id = $task->id_text;

        $taskCreate = $this->taskService->create($taskDTO);
        
        $this->assertInstanceOf(Task::class, $taskCreate);

        $taskDTO->created_at = $taskCreate->created_at;
        $taskDTO->updated_at = $taskCreate->updated_at;
        $taskDTO->id = $task->id;

        $this->assertDatabaseHas('tasks', $taskDTO->toArray());
    }

    public function testTaskAlreadyExistsException()
    {
        $task = Task::factory()->create();

        $taskDTO = TaskDTO::from($task->toArray());
        $taskDTO->id = $task->id_text;

        $this->expectException(TaskAlreadyExistsException::class);

        $this->taskService->create($taskDTO);
    }

    public function testUserNotFoundException()
    {
        $task = Task::factory()->make();

        $taskDTO = TaskDTO::from($task->toArray());
        $taskDTO->id = $task->id_text;

        do {
            $taskDTO->user_id = rand();
        } while ($taskDTO->user_id == $task->user_id);

        $this->expectException(UserNotFoundException::class);

        $this->taskService->create($taskDTO);
    }
}
