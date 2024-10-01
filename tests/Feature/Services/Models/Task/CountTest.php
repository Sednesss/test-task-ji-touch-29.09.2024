<?php

namespace Tests\Feature\Services\Models\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountTest extends TaskServiceTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulCompletion()
    {
        Task::factory()->count(5)->create();

        $tasksCount = $this->taskService->count();

        $this->assertIsInt($tasksCount);
        $this->assertEquals($tasksCount, 5);
    }
}
