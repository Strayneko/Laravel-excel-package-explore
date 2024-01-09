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
    /**
     * Store the data into database
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $data = request()->input('data');

        try{
            $data = is_array($data) ? $data : json_decode($data, true);
            $mappedData = $this->mapData($data);
            User::insert($mappedData);

        return response()->json([
            'status'  => Response::HTTP_CREATED,
            'message' => 'Data has been added successfully.',
        ], Response::HTTP_CREATED);
        }catch(QueryException $e){
            Log::error($e->getMessage());

            return response()->json([
                'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function mapData(?array $data): array
    {
        $dataIsNotValid = is_null($data) || (!is_null($data) && empty($data));
        if($dataIsNotValid) return [];

        return array_map(function($item){
            return [
              'email'       => $item['email'] ?? null,
              'name'        => $item['name'] ?? null,
              'created_at' => now(),
              'updated_at' => now(),
            ];
        }, $data);
    }

    /**
     * Deletes data from the database by the list of emails given in request
     * @return JsonResponse
     */
    public function destroy()
    {
        $data = request()->input('data');
        $data = is_array($data) ? $data : json_decode($data, 1);

        $dataIsNotValid = is_null($data) || (!is_null($data) && empty($data));
        $data = $dataIsNotValid ? [] : $data;

        $data = array_map(fn ($item) => $item['email']
        , $data);

        $query = User::query()->whereIn('email', $data);
        $count = $query->count();
        $query->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Data has been deleted successfully.',
            'data' => compact('count'),
        ]);
    }

}
