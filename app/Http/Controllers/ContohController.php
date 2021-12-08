<?php

namespace App\Http\Controllers;

use App\Example;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ContohController extends Controller
{
    public function fetch()
    {
        $datas = Example::where('deleted_at', null);
        $paginate = $datas->paginate(\request()->get('limit'));

        return \response()->json([
            'data' => [
                'currentPage' => $paginate->currentPage(),
                'from' => $paginate->firstItem() ?? 0,
                'lastPage' => $paginate->lastPage(),
                'perPage' => (int)$paginate->perPage(),
                'to' => $paginate->lastItem() ?? 0,
                'total' => $paginate->total(),
                'items' => $paginate->items() ?? [],
            ],
            'message' => 'ok',
            'success' => true
        ]);
    }

    public function detail($id)
    {
        $selectData = Example::where('example_id', $id);

        if (!$selectData->exists()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => "ID tidak ditemukan",
                'success' => false
            ]);
        }

        return response()->json([
            'data' => $selectData->first(),
            'message' => "ok",
            'success' => true
        ]);

    }

    public function store(Request $request)
    {
        $inputUser = $request->only('example_name', 'example_phone');

        $validator = Validator::make($inputUser, [
            'example_name' => 'required',
            'example_phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => implode(' \n ', $validator->getMessageBag()->all()),
                'success' => false
            ]);
        }

        $inputUser['example_id'] = Uuid::uuid1();
        $savingData = Example::create($inputUser);

        if ($savingData) {
            return response()->json([
                'data' => $inputUser,
                'message' => "ok",
                'success' => true
            ]);
        }

        return response()->json([
            'data' => new \stdClass(),
            'message' => "Terjadi masalah pada saat menyimpan data coba beberapa saat lagi",
            'success' => false
        ]);
    }

    public function update(Request $request, $id)
    {
        $inputUser = $request->only('example_name', 'example_phone');

        $validator = Validator::make($inputUser, [
            'example_name' => 'required',
            'example_phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => implode(' \n ', $validator->getMessageBag()->all()),
                'success' => false
            ]);
        }

        $selectData = Example::where('example_id', $id);

        if (!$selectData->exists()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => "ID tidak ditemukan",
                'success' => false
            ]);
        }

        $updateingData = $selectData->update($inputUser);

        if ($updateingData) {
            return response()->json([
                'data' => $selectData->first(),
                'message' => "ok",
                'success' => true
            ]);
        }

        return response()->json([
            'data' => new \stdClass(),
            'message' => "Terjadi masalah pada saat menyimpan data coba beberapa saat lagi",
            'success' => false
        ]);
    }

    public function destroy($id)
    {
        $selectData = Example::where('example_id', $id);

        if (!$selectData->exists()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => "ID tidak ditemukan",
                'success' => false
            ]);
        }
        $data = $selectData->first();
        $deletingData = $data->delete();

        return response()->json([
            'data' => $data,
            'message' => "ok",
            'success' => true
        ]);
    }
}
