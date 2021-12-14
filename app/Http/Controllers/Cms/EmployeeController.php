<?php

namespace App\Http\Controllers\Cms;

use App\EmployeeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $datas = EmployeeModel::where('deleted_at', null);
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
        $selectData = EmployeeModel::where('employee_id', $id);

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
        //belom selesai
        $inputUser = $request->all();

        $validator = Validator::make($inputUser, [
            'employee_id' => 'required',
            'user_roles_id' => 'required',
            'employee_firstname' => 'required',
            'employee_middlename' => 'required',
            'employee_lastname' => 'required',
            'employee_username' => 'required',
            'employee_password' => 'required', 
            'employee_email' => 'required',
            'employee_status' => 'required',
            'employee_image' => 'required',
            'created_by' => 'required',
            'update_by' => 'required'
        ],
        [
            'employee_id.required' => 'Masukan Employee Id',
            'user_roles_id.required' => 'Masukan Id',
            'employee_firstname.required' => 'Masukan Firstname',
            'employee_middlename.required' => 'Masukan Secondname',
            'employee_lastname.required' => 'Masukan Lastname',
            'employee_username.required' => 'Masukan Username',
            'employee_password.required' => 'Masukan Password',
            'employee_status.required' => 'Masukan Status',
            'employee_email.required' => 'Masukan Email',          
            'employee_image.required' => 'Masukan Image ',
            'created_by.required' => 'Created Oleh',
            'update_by.required' => 'Update Oleh'
        ]
    );

        if ($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => implode(' \n ', $validator->getMessageBag()->all()),
                'success' => false
            ]);
        }

        $inputUser['employee_id'] = Uuid::uuid1();
        $inputUser['employee_password'] = Hash::make($inputUser['employee_password']);
        $savingData = EmployeeModel::insert($inputUser);

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
        //belom selesai
        $inputUser = $request->only(
            'employee_username', 'employee_email','employee_password'
        );

        $validator = Validator::make($inputUser, [
            'employee_username' => 'required',
            'employee_password' => 'required', 
            'employee_email' => 'required'
        ],
        [
            'employee_username.required' => 'Masukan Username',
            'employee_password.required' => 'Masukan Password',
            'employee_email.required' => 'Masukan Email'
        ]
    );
        // dd($validator->fails());
        if ($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message' => implode(' \n ', $validator->getMessageBag()->all()),
                'success' => false
            ]);
        }

        $inputUser['employee_password'] = Hash::make($inputUser['employee_password']);
        $selectData = EmployeeModel::where('employee_id', $id);

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
        $selectData = EmployeeModel::where('employee_id', $id);

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
