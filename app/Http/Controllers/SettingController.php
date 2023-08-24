<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getAllSettings(Request $request)
    {
        $settings = Setting::get()->mapWithKeys(function ($setting) {
            return [$setting['key'] => $setting['value']];
        });

        return $this->successResponse(
            'Successfully retrieved all settings.',
            $settings
        );
    }
}
