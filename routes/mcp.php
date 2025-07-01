<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\McpController;

Route::get('/mcp', [McpController::class, 'index']);
