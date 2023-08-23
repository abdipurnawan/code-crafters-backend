<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse($message = 'Success', $data = null)
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'OK',
            'message'   => $message,
            'data'      => $data
        ], 200);
    }

    protected function failedResponse($message = 'Failed')
    {
        return response()->json([
            'code'      => 400,
            'status'    => 'OK',
            'message'   => $message,
        ], 400);
    }

    protected function exceptionResponse($message = 'Internal Server Error')
    {
        return response()->json([
            'code'      => 500,
            'status'    => 'OK',
            'message'   => $message,
        ], 500);
    }
}
