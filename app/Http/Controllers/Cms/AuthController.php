<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmployeeModel;


class AuthController extends Controller
{
    public function register (Request $request)
    {
        $data = $request->all();
        $employee_id = $data["employee_id"]->toString();
        $user_roles_id = $request->input('user_roles_id');
        $employee_firstname = $request->input('employee_firstname');
        $employee_middlename = $request->input('employee_middlename');
        $employee_lastname = $request->input('employee_lastname');
        $employee_username= $request->input('employee_username');
        $employee_password = Hash::make($request->input('employee_password'));
        $employee_email = $request->input('employee_email');
        $employee_status = $request->input('employee_status');
        $employee_image = $request->input('employee_image');
        $created_by = $request->input('created_by');
        $update_by = $request->input('update_by');

    
        $register = EmployeeModel::create([
        'employee_id' => $employee_id,
        'user_roles_id' => $user_roles_id,
        'employee_firstname' => $employee_firstname,
        'employee_middlename' => $employee_middlename,
        'employee_lastname' => $employee_lastname,
        'employee_username' => $employee_username,
        'employee_password' => $employee_password,
        'employee_email' => $employee_email,
        'employee_status' => $employee_status,
        'employee_image' => $employee_image,
        'created_by' => $created_by,
        'update_by' => $update_by
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'message' => "Register Success!",
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Register Fail!",
                'data' => ''
            ], 400); 
        }
    }
}