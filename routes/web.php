<?php

use Illuminate\Support\Facades\Route;


Route::get("/chatgpt", \App\Http\Controllers\PostController::class);
Route::get("/copilot", \App\Http\Controllers\ArticleController::class);
