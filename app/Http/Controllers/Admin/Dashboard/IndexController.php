<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;
use App\Services\Models\TaskService;
use App\Services\Models\UserService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function __invoke(UserService $userService, TaskService $taskService): View
    {
        try {
            $usersCount = $userService->count();
            $tasksCount = $taskService->count();
        } catch (BaseException $e) {
            Log::error('Admin::Dashboard:::IndexController:' . $e->getMessage());
            abort(500);
        } catch (Exception $e) {
            Log::error('Admin::Dashboard:::IndexController:' . $e->getMessage());
            abort(500);
        }

        return view('admin_panel.dashboards.index', [
            'tasksCount' => $tasksCount,
            'usersCount' => $usersCount
        ]);
    }
}
