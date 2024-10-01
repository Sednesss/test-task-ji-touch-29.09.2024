<?php

namespace App\Http\Controllers\Admin\Task;

use App\DTO\Models\TaskDTO;
use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Task\UpdateRequest;
use App\Services\Models\TaskService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $updateRequest, TaskService $taskService, string $taskId): RedirectResponse
    {
        try {
            $taskIdAsBinary = Uuid::fromString($taskId)->getBytes();
            $task = $taskService->find($taskIdAsBinary);
            $taskDTO = TaskDTO::from($task->toArray());

            $taskDTO->title = $updateRequest->title;
            $taskDTO->description = $updateRequest->description;
            $taskDTO->completed = $updateRequest->completed;

            $taskService->update($taskDTO);
        } catch (BaseException $e) {
            Log::error('Admin::Task:::UpdateController:' . $e->getMessage());
            abort(500);
        } catch (Exception $e) {
            Log::error('Admin::Task:::UpdateController:' . $e->getMessage());
            abort(500);
        }

        return redirect()->route('admin_panel::tasks::index');
    }
}
