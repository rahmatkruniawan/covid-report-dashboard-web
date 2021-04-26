<?php

namespace App\Services\Inform\Builder;

use Illuminate\Http\Request;

class ResponseBuilder
{
    public function successfullySaveData($response)
    {
        return response()->json($response, 201);
    }

    public function successfullyLoadData($data)
    {
        return response()->json($data, 200);
    }

    public function error($error)
    {
        $response['error'] = $error;
        return response()->json($response, 400);
    }
}
