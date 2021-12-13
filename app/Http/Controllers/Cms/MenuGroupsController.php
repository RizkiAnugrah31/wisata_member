<?php

namespace App\Http\Controllers\Cms;

use App\MenuGroupsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;


class MenuGroupsController extends Controller
{
    public function index(Request $request)
    {
        $datas = MenuGroupsModel::where('deleted_at', null);
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
        $selectData = MenuGroupsModel::where('menu_group_id', $id);

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
        $inputUser = $request->all();

        $validator = Validator::make($inputUser, [
            'menu_group_id' => 'required',
            'menu_id' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'sequence' => 'icon'
        ],
        [
            'menu_group_id' => 'Masukukan ID',
            'menu_id' => 'Masukan Id',
            'name.required' => 'Masukan Nama',
            'icon.required' => 'Masukan Icon',
            'sequence.required' => 'Masukan sequence'

        ]
    );

    dd($validator->fails());

    if ($validator->fails()) {
        return response()->json([
            'data' => new \stdClass(),
            'message' => implode(' \n ', $validator->getMessageBag()->all()),
            'success' => false
        ]);
    }

        $inputUser['menu_group_id'] = Uuid::uuid1();
        $savingData = MenuGroupsModel::insert($inputUser);

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
       $inputUser = $request->all();

        $validator = Validator::make($inputUser, [
            'menu_group_id' => 'required',
            'menu_id' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'sequence' => 'icon'
        ],
        [
            'menu_group_id' => 'Masukukan ID',
            'menu_id' => 'Masukan Id',
            'name.required' => 'Masukan Nama',
            'icon.required' => 'Masukan Icon',
            'sequence.required' => 'Masukan sequence'

        ]
    );

        if ($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => implode(' \n ', $validator->getMessageBag()->all()),
                'success' => false
            ]);
        }

        $selectData = MenuGroupsModel::where('menu_group_id', $id);

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
    public function delete($id)
    {
        $selectData = MenuGroupsModel::where('menu_group_id', $id);

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
