<?php

namespace App\Services\Models;

use App\DTO\Models\TaskDTO;
use App\Exceptions\Models\Task\TaskAlreadyExistsException;
use App\Exceptions\Models\Task\TaskNotFoundException;
use App\Exceptions\Models\User\UserNotFoundException;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class TaskService
{
    private Task $model;
    private UserService $userService;

    public function __construct(Task $model, UserService $userService)
    {
        $this->model = $model;
        $this->userService = $userService;
    }

    /**
     * @throws TaskNotFoundException
     */
    public function find(string $id): Task
    {
        $task = $this->model->find($id);

        if (!$task) {
            throw new TaskNotFoundException();
        }

        return $task;
    }

    /**
     * @throws UserNotFoundException
     * @return Collection|Task[]
     */
    public function list(?string $userId = null): Collection
    {
        if ($userId) {
            $user = $this->userService->find($userId);

            if ($user instanceof User) {
                return $user->tasks;
            }
        }

        return Task::all();
    }

    public function count(): int
    {
        return Task::count();
    }

    /**
     * @throws TaskAlreadyExistsException
     * @throws UserNotFoundException
     */
    public function create(TaskDTO $taskDTO): Task
    {
        $idAsBinary = Uuid::fromString($taskDTO->id)->getBytes();
        if ($this->model->where('id', $idAsBinary)->count() > 0) {
            throw new TaskAlreadyExistsException();
        }

        $this->userService->find($taskDTO->user_id);

        return $this->model->create($taskDTO->toArray());
    }

    /**
     * @throws TaskNotFoundException
     * @throws UserNotFoundException
     */
    public function update(TaskDTO $taskDTO): Task
    {
        $task = $this->find($taskDTO->id);
        $this->userService->find($taskDTO->user_id);

        $taskDTO->id = Uuid::fromBytes($taskDTO->id)->toString();

        $task->update($taskDTO->toArray());
        return $task;
    }

    /**
     * @throws TaskNotFoundException
     */
    public function delete(string $id)
    {
        $task = $this->find($id);
        $task->delete($task->id);
    }
}
