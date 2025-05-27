<?php

namespace App\Http\Controllers;

use App\Http\Helpers\TasksHelper;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json(['tasks' => $tasks], 200);
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            $validated = $request->validated();
            $task = Task::create($validated);

            return response()->json(["message" => "Task criada com sucesso!", "task" => $task], 201);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao criar task!", "error" => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $task = TasksHelper::findTask($id);

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
            $task = TasksHelper::findTask($id);

            if (empty($task)) {
                return response()->json(['message' => "Task não encontrada"], 404);
            }

            $validated = $request->validated();
            $task->update($validated);

            return response()->json(['message' => "Task atualizada com sucesso!", "task" => $task], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar task!', "error" => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $task = TasksHelper::findTask($id);

            if (empty($task)) {
                return response()->json(['message' => "Task não encontrada"], 404);
            }
            return response()->json(["message" => "Task apagada com sucesso!"], 204);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro ao apagar!", "error" => $e->getMessage()], 500);
        }
    }
}
