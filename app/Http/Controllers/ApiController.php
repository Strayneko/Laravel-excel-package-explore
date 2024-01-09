<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = $request->input('data');

        try{
            $mappedData = $this->mapData($data);
            User::insert($mappedData);

        return response()->json([
            'status'  => Response::HTTP_CREATED,
            'message' => '',
        ]);
        }catch(QueryException $e){
            Log::error($e->getMessage());

            return response()->json([
                'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function mapData(array $data): array
    {
        return array_map(function($item){
            return [
              'email'       => $item['email'] ?? null,
              'name'        => $item['password'] ?? null,
              'created_at' => now(),
              'updated_at' => now(),
            ];
        }, $data);
    }

    public function store()
    {
        return response()->json(json_decode(request()->data));
    }
}
