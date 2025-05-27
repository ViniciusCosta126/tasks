<?php

namespace App\Http\Helpers;

use App\Models\Task;


class TasksHelper
{
    public static function findTask($id): Task
    {
        $task = Task::where('id', $id)->first();
        return $task;
    }
}
