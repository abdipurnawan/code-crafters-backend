<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Get all blogs.
     * @params is_active
     * @params is_paginated
     * @params page
     * @params per_page
     * $params tags
     */
    public function getAllBlogs(Request $request)
    {
        $blogs = Blog::query();

        // search filter
        if (isset($request->search)) {
            $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        // tags filter
        if (isset($request->tag_id)) {
            $blogs->whereHas('tags', function ($query) use ($request) {
                $query->where('tag_id', $request->tag_id);
            });
        }

        $blogs = $blogs->with('thumbnail')
            ->where('post_type', 'post')
            ->where('status', 'publish')
            ->where('published_at', '<=', now())
            ->orderBy('created_at', 'desc')
            ->paginate($request->per_page ?? 6)
            ->through(function ($blog) {
                return $this->clearJsonInBlog($blog);
            });

        return $this->successResponse(
            'Successfully retrieved all blogs.',
            $blogs
        );
    }

    public function getLastestBlogs()
    {
        // find blog
        $blog = Blog::query()
            ->with('author', 'thumbnail')
            ->where('post_type', 'post')
            ->where('status', 'publish')
            ->where('published_at', '<=', now())
            ->orderBy('created_at', 'desc')
            ->first();

        // clear blog data
        if ($blog) {
            $blog = $this->clearJsonInBlog($blog);
        }

        // return response
        return $this->successResponse(
            'Successfully retrieved lastest blogs.',
            $blog
        );
    }

    public function findBlogBySlug($slug)
    {
        $blog = Blog::query()
            ->with('author', 'thumbnail')
            ->where('post_type', 'post')
            ->where('status', 'publish')
            ->where('published_at', '<=', now())
            ->where('slug', $slug)
            ->first();

        // clear blog data
        if ($blog) {
            $blog = $this->clearJsonInBlog($blog);
        }

        return $this->successResponse(
            'Successfully retrieved blog.',
            $blog
        );
    }

    private function clearJsonInBlog($blog)
    {
        // decode blog json
        $title = json_decode($blog->title)->id;
        $description = json_decode($blog->description)->id;
        $content = json_decode($blog->content)->id;

        // set value
        $blog->title = $title;
        $blog->description = $description;
        $blog->content = $content;

        return $blog;
    }
}
