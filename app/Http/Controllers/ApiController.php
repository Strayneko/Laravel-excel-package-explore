<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Movie::all(),
        ]);
    }

    public function store()
    {
        return response()->json(json_decode(request()->data));
    }
}
