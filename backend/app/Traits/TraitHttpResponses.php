<?php

namespace App\Traits;

trait TraitHttpResponses
{
    protected function success($data, $message = "", $status = 200)
    {
        return response()->json([
            "message" => $message,
            "data" => $data
        ], $status);
    }

    protected function error($message, $status = 500)
    {
        return response()->json([
            "message" => $message
        ], $status);
    }
}
