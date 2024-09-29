<?php

namespace App\Exceptions\Models\Task;

use App\Exceptions\BaseException;

class TaskNotFoundException extends BaseException
{
    public function __construct(string $message = '', array $args = [])
    {
        $message = $message ?: 'Task not found in the database.';
        $messageCode = 'TASK_NOT_FOUND';

        parent::__construct($message, $args, $messageCode);
    }
}
