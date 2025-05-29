<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Services\TaskService;
use App\Traits\TraitHttpResponses;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public TaskService $taskService;
    use TraitHttpResponses;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasksActive();
        return $this->success($tasks, "Tasks encontradas com sucesso!");
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $task = $this->taskService->createTask($validated);
        return $this->success($task, "Task criada com sucesso!", 201);
    }

    public function show($id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);
        return $this->success($task, "Task encontrada com sucesso!");
    }

    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);
        $validated = $request->validated();
        $task = $this->taskService->updateTask($task, $validated);

        return $this->success($task, "Task atualizada com sucesso!");
    }

    public function destroy($id)
    {
        $task = $this->taskService->getTaskById($id);
        $this->taskService->deleteTask($task);

        return $this->success("", "", 204);
    }
}
