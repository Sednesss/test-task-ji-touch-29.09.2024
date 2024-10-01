<?php

namespace Tests\Feature\Services\Models\Task;

use App\Services\Models\TaskService;
use Tests\TestCase;

class TaskServiceTestCase extends TestCase
{
    protected TaskService $taskService;

    public function setUp(): void
    {
        parent::setUp();

        $this->taskService = resolve(TaskService::class);
    }
}
