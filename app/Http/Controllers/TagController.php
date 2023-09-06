<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getAllTags(Request $request)
    {
        $tags = Tag::get()->map(function ($tag) {
            return $this->clearJsonInBlog($tag);
        });

        return $this->successResponse(
            'Successfully retrieved all tags.',
            $tags
        );
    }

    private function clearJsonInBlog($tag)
    {
        // decode json
        $name = json_decode($tag->name)->en;
        $slug = json_decode($tag->slug)->en;

        // set value
        $tag->name = $name;
        $tag->slug = $slug;

        return $tag;
    }
}
