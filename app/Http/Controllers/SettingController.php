<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getAllSettings(Request $request)
    {
        return $this->successResponse('Sukses', [
            'name' => 'Setting 1',
            'age' => 20
        ]);
    }
}
