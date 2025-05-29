<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Services\TaskService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasksActive();
        return response()->json(['tasks' => $tasks], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            $validated = $request->validated();
            $task = $this->taskService->createTask($validated);

            return response()->json(["message" => "Task criada com sucesso!", "task" => $task], 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao criar task!", "error" => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $task = $this->taskService->getTaskById($id);

            if (empty($task)) {
                return response()->json(['message' => "Task não encontrada"], 404);
            }
            return response()->json(['message' => "Task encontrada!", "task" => $task], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao buscar task", "error" => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        try {
            $task = $this->taskService->getTaskById($id);

            if (empty($task)) {
                return response()->json(['message' => "Task não encontrada"], 404);
            }

            $validated = $request->validated();
            $task = $this->taskService->updateTask($task, $validated);

            return response()->json(['message' => "Task atualizada com sucesso!", "task" => $task], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar task!', "error" => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $task = $this->taskService->getTaskById($id);

            if (empty($task)) {
                return response()->json(['message' => "Task não encontrada"], 404);
            }

            $this->taskService->deleteTask($task);

            return response()->json(["message" => "Task apagada com sucesso!"], 204);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao apagar!", "error" => $e->getMessage()], 500);
        }
    }
}
