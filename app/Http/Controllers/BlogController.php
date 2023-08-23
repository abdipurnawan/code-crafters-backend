<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllBlogs(Request $request)
    {
        return $this->successResponse('Sukses', [
            'name' => 'Rizal',
            'age' => 20
        ]);
    }

    public function findBlogBySlug($slug)
    {
        return $this->successResponse('Sukses', [
            'slug' => $slug,
        ]);
    }
}
