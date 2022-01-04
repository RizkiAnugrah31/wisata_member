<?php

namespace App\Http\Controllers\Cms;

use App\TourModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController
{
    public function index(Request $request): JsonResponse
    {
        $data = (new TourModel)->where('deleted_at', '=', null);

        $paging = $data->paginate($request->get('limit'));

        return response()->json([
            'data' => [
                'currentPage' => $paging->currentPage(),
                'from' => $paging->firstItem() ?? 0,
                'lastPage' => $paging->lastPage(),
                'perPage' => $paging->perPage(),
                'to' => $paging->lastItem() ?? 0,
                'total' => $paging->total(),
                'items' => $paging->items() ?? []
            ],
            'message' => 'ok',
            'success' => true
        ]);
    }
}
