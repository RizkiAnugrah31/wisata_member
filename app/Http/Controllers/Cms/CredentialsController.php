<?php

namespace App\Http\Controllers\Cms;

use App\CredentialsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;

class CredentialsController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        //        Get all data Menu from database
        $data = CredentialsModel::paginate($request->limit);
        if ($data) {
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Credentials Service Membership Gagal Mendapatkan Data',
                'success' => false
            ]);
        }
    }

    public function detail($id){
        $data = CredentialsModel::find($id);
        if ($data) {
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Credentials Service Membership Gagal Mendapatkan Data',
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
        $data["credential_id"] = $uuid1->toString();
        $data["secret_key"] = Hash::make($data["secret_key"], [
            'rounds' => 12,]);
//        query create
        $create = CredentialsModel::insert($data);
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
                'message' => 'Credentials Service Membership Gagal Mendapatkan Data',
                'success' => false
            ]);
        }
        // return $data;
        
    }
    public function update(Request $request, $id)
    {
//        Get All data from request
        $data = $request->all();
        // dd($id);
//        query update
        $update = CredentialsModel::where('credential_id',$id)->update($data);
//        check if update success or not
        // dd($update);
        if ($update) {
            return response()->json([
                'data' => $update,
                'message' => 'Berhasil',
                'success' => true
            ]);
        } else {
            return response()->json([
                'data' => '' ,
                'message' => 'Credentials Service Membership Gagal Mendapatkan Data',
                'success' => false
            ]);
        }
    }
    public function delete($id)
    {
//        query update
        $delete = CredentialsModel::find($id)->delete();
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
                'message' => 'Credentials Service Membership Gagal Mendapatkan Data',
                'success' => false
            ]);
        }
    }

}
