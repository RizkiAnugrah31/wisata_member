<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function exampleGet()
    {
        $contohData = [
            [
                'example_id' => 1,
                'example_name' => 'name 1'
            ],
            [
                'example_id' => 2,
                'example_name' => 'name 2'
            ],
            [
                'example_id' => 3,
                'example_name' => 'name 3'
            ],
            [
                'example_id' => 4,
                'example_name' => 'name 4'
            ],
            [
                'example_id' => 5,
                'example_name' => 'name 5'
            ]
        ];

        return response()->json([
            'data' => $contohData
        ]);
    }

    public function examplePost(Request $request)
    {
        // uncomment di bawah bwt balikin semua body request
        // return $request->all();
        // uncomment di bawah bwt ambil data dari body request
         return response()->json([
             'nama' => $request->nama
         ]);
    }
}
