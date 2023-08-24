<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestimonyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Tags
Route::get('tags', [TagController::class, 'getAllTags']);

// Blogs
Route::get('blogs', [BlogController::class, 'getAllBlogs']);
Route::get('lastest-blogs', [BlogController::class, 'getLastestBlogs']);
Route::get('blogs/{slug}', [BlogController::class, 'findBlogBySlug']);

// Services
Route::get('services', [ServiceController::class, 'getAllServices']);

// Testimony
Route::get('testimonies', [TestimonyController::class, 'getAllTestimonies']);

// Setting
Route::get('settings', [SettingController::class, 'getAllSettings']);
