<?php

namespace App\Http\Controllers\Admin\Task;

use App\DTO\Models\TaskDTO;
use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Task\StoreRequest;
use App\Services\Models\TaskService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $storeRequest, TaskService $taskService): RedirectResponse
    {
        try {
            $taskDTO = TaskDTO::from([
                'id' => Uuid::uuid4()->toString(),
                'title' => $storeRequest->title,
                'user_id' => Auth::user(),
                'description' => $storeRequest->description,
                'completed' => false
            ]);

            $taskService->create($taskDTO);
        } catch (BaseException $e) {
            Log::error('Admin::Task:::StoreController:' . $e->getMessage());
            abort(500);
        } catch (Exception $e) {
            Log::error('Admin::Task:::StoreController:' . $e->getMessage());
            abort(500);
        }

        return redirect()->route('admin_panel::tasks::index');
    }
}
