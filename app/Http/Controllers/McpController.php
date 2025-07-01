<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class McpController extends Controller
{
    public function index()
    {
        return response()->json([
            'tools' => [],
            'resources' => [],
            'prompts' => [],
        ]);
    }
}
