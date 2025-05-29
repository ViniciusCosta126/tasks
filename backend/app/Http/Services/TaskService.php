<?php

namespace App\Http\Services;

use App\Exceptions\NotFoundException;
use App\Models\Task;


class TaskService
{

    public function getAllTasksActive()
    {
        $tasks = Task::where('ativa', 1)->get();
        return $tasks;
    }

    public function createTask($data): Task
    {
        $task = Task::create($data);
        return $task;
    }

    public function getTaskById($id): Task|null
    {
        $task = Task::where('id', $id)->first();

        if (!$task) {
            throw new NotFoundException("Task não encontrada!");
        }
        return $task;
    }

    public function updateTask(Task $task, $data): Task
    {
        $task->update($data);
        return $task;
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}