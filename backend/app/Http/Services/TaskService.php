<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\TaskResource;
use App\Models\Task;


class TaskService
{

    public function getAllTasksActive()
    {
        $tasks = Task::where('ativa', 1)->get();
        return TaskResource::collection($tasks);
    }

    public function createTask($data): TaskResource
    {
        $task = Task::create($data);
        return new TaskResource($task);
    }

    public function getTaskById($id): TaskResource|null
    {
        $task = Task::with(['comentarios'])->where('id', $id)->first();

        if (!$task) {
            throw new NotFoundException("Task não encontrada!");
        }
        return new TaskResource($task);
    }

    public function updateTask(Task $task, $data): TaskResource
    {
        $task->update($data);
        return new TaskResource($task);
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}