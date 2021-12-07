<?php

namespace App\Http\Controllers\Cms;

use App\UserRolesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class UserRolesController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        //        Get all data Menu from database
        $data = UserRolesModel::paginate($request->limit);
        if ($data) {
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Tidak Berhasil',
                'success' => false
            ]);
        }
    }

    public function detail($id){
        $data = UserRolesModel::find($id);
        if ($data) {
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '',
                'message' => 'Tidak Berhasil',
                'success' => false
            ]);
        }
    }



    public function store(Request $request)
    {
//        Get All data from request
        // dd($request->all());
        $data = $request->all();
        $uuid1 = Uuid::uuid1();
        $data["user_roles_id"] = $uuid1->toString();
//        query create
        $create = UserRolesModel::insert($data);
//        check if create success or not
        if ($create) {
            return response()->json([
                'data' => $create,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Tidak Berhasil',
                'success' => false
            ]);
}
    }
    public function update(Request $request, $id)
    {
//        Get All data from request
        $data = $request->all();
//        query update
        $update = UserRolesModel::where('user_roles_id',$id)->update($data);
//        check if update success or not
        if ($update) {
            return response()->json([
                'data' => $update,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Tidak Berhasil',
                'success' => false
            ]);
         }
    }
    public function delete($id)
    {
//        query update
        $delete = UserRolesModel::find($id)->delete();
//        check if delete success or not
        if ($delete) {
            return response()->json([
                'data' => $delete,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Tidak Berhasil',
                'success' => false
            ]);
        }
    }
}
