<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAllServices(Request $request)
    {
        return $this->successResponse('Sukses', [
            'name' => 'Service 1',
            'age' => 20
        ]);
    }
}
