<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAllServices(Request $request)
    {
        $services = Service::where('is_active', 1)->get([
            'id',
            'name',
            'description',
        ]);

        return $this->successResponse(
            'Successfully retrieved all services.',
            $services
        );
    }
}
