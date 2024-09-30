<?php

namespace App\Http\Controllers\Admin\Task;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Task\DestroyRequest;
use App\Models\Task;
use App\Services\Models\TaskService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class DestroyController extends Controller
{
    public function __invoke(DestroyRequest $destroyRequest, TaskService $taskService, Task $task): RedirectResponse
    {
        try {
            $taskService->delete($task->id);
        } catch (BaseException $e) {
            Log::error('Admin::Task:::DestroyController:' . $e->getMessage());
            abort(500);
        } catch (Exception $e) {
            Log::error('Admin::Task:::DestroyController:' . $e->getMessage());
            abort(500);
        }

        return redirect()->route('admin_panel::tasks::index');
    }
}
