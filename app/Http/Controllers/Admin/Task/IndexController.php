<?php

namespace App\Http\Controllers\Admin\Task;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Services\Models\TaskService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function __invoke(TaskService $taskService): View
    {
        try {
            $tasksList = $taskService->list();
        } catch (BaseException $e) {
            Log::error('Admin::Task:::IndexController:' . $e->getMessage());
            abort(500);
        } catch (Exception $e) {
            Log::error('Admin::Task:::IndexController:' . $e->getMessage());
            abort(500);
        }

        return view('admin_panel.tasks.index', [
            'tasks' => $tasksList,
        ]);
    }
}
