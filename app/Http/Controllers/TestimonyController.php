<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function getAllTestimonies(Request $request)
    {
        $testimonies = Testimony::where('is_active', 1)->get([
            'id',
            'name',
            'image',
            'testimony',
        ]);

        return $this->successResponse(
            'Successfully retrieved all testimonies.',
            $testimonies
        );
    }
}
