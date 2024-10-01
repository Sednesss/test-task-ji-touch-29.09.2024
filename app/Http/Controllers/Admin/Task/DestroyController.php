<?php

namespace App\Http\Controllers\Admin\Task;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Task\DestroyRequest;
use App\Services\Models\TaskService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class DestroyController extends Controller
{
    public function __invoke(DestroyRequest $destroyRequest, TaskService $taskService, string $taskId): RedirectResponse
    {
        try {
            $taskIdAsBinary = Uuid::fromString($taskId)->getBytes();
            $taskService->delete($taskIdAsBinary);
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
