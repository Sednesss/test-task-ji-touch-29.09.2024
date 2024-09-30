<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Contracts\View\View;

class EditController extends Controller
{
    public function __invoke(Task $task): View
    {
        return view('admin_panel.tasks.edit', [
            'task' => $task
        ]);
    }
}
