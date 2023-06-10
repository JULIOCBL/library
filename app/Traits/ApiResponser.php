<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response(['data' => $data], $code)->header('Content-Type', 'application/json');
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['errors' => $message, 'code' => $code], $code);
    }

    public function errorMessage($message, $code)
    {
        return response(['errors' => [$message]], $code)->header('Content-Type', 'application/json');
    }
}
