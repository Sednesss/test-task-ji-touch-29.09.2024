<?php

namespace Tests\Feature\Services\Models\Task;

use App\DTO\Models\TaskDTO;
use App\Exceptions\Models\Task\TaskNotFoundException;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TaskServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        $task = Task::factory()->create();

        $taskDTO = TaskDTO::from($task->toArray());

        $this->taskService->delete($task->id);

        $taskDTO->id = $task->id;

        $this->assertDatabaseMissing('tasks', $taskDTO->toArray());
    }

    public function testTaskNotFoundException()
    {
        $task = Task::factory()->create();

        do {
            $randomId = rand();
        } while ($randomId == $task->id);

        $this->expectException(TaskNotFoundException::class);

        $this->taskService->delete($randomId);
    }
}
