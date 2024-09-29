<?php

namespace Tests\Feature\Services\Models\Task;

use App\Exceptions\Models\Task\TaskNotFoundException;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FindTest extends TaskServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        $task = Task::factory()->create();

        $taskFind = $this->taskService->find($task->id);

        $this->assertInstanceOf(Task::class, $taskFind);
        $this->assertEquals($task->toArray(), $taskFind->toArray());
    }

    public function testTaskNotFoundException()
    {
        $task = Task::factory()->create();

        do {
            $randomId = rand();
        } while ($randomId == $task->id);

        $this->expectException(TaskNotFoundException::class);

        $this->taskService->find($randomId);
    }
}
