<?php

namespace App\Exceptions\Models\Task;

use App\Exceptions\BaseException;

class TaskAlreadyExistsException extends BaseException
{
    public function __construct(string $message = '', array $args = [])
    {
        $message = $message ?: 'A task with the current ID already exists in the database.';
        $messageCode = 'TASK_ID_UNIQUE';

        parent::__construct($message, $args, $messageCode);
    }
}
