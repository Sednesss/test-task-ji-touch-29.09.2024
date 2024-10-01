<?php

namespace App\Http\Controllers\Admin\Task;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Services\Models\TaskService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class ConfirmDeleteController extends Controller
{
    public function __invoke(TaskService $taskService, string $taskId): View
    {
        try {
            $taskIdAsBinary = Uuid::fromString($taskId)->getBytes();
            $task = $taskService->find($taskIdAsBinary);
        } catch (BaseException $e) {
            Log::error('Admin::Task:::ConfirmDeleteController:' . $e->getMessage());
            abort(500);
        } catch (Exception $e) {
            Log::error('Admin::Task:::ConfirmDeleteController:' . $e->getMessage());
            abort(500);
        }

        return view('admin_panel.tasks.confirm_delete', [
            'task' => $task
        ]);
    }
}
