<?php

namespace App\Http\Controllers\Cms;

use App\EmployeeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        //        Get all data Menu from database
        $data = EmployeeModel::paginate($request->limit);
        return $data;
    }

    public function detail($id){
        $data = EmployeeModel::find($id);
        return $data;
    }



    public function store(Request $request)
    {
//        Get All data from request
        // dd($request->all());
        $data = $request->all();
        $uuid1 = Uuid::uuid1();
        $data["employee_id"] = $uuid1->toString();
//        query create
        $create = EmployeeModel::insert($data);
//        check if create success or not
        if ($create) {
            return "success";
        } else {
            return "false";
        }
    }
    public function update(Request $request, $id)
    {
//        Get All data from request
        $data = $request->all();
        // dd($id);
//        query update
        $update = EmployeeModel::where('employee_id',$id)->update($data);
//        check if update success or not
        // dd($update);
        if ($update) {
            return "success";
        } else {
            return "false";
        }
    }
    public function delete($id)
    {
//        query update
        $delete = EmployeeModel::find($id)->delete();
//        check if delete success or not
        if ($delete) {
            return "success";
        } else {
            return "false";
        }
    }
}
