<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $taskRepository
    ) {}

    public function getAllTasks(): LengthAwarePaginator
    {
        return $this->taskRepository->getAllPaginated();
    }

    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask(Task $task, array $data): Task
    {
        return $this->taskRepository->update($task, $data);
    }

    public function deleteTask(Task $task): bool
    {
        return $this->taskRepository->delete($task);
    }

    public function toggleStatus(Task $task): Task
    {
        $newStatus = $task->status->value === TaskStatus::PENDING->value ? TaskStatus::COMPLETED->value : TaskStatus::PENDING->value;
        return $this->taskRepository->updateStatus($task, $newStatus);
    }
}
