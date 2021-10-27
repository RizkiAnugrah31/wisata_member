<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmployeeModel;
use Firebase\JWT\JWT;
use Illuminate\Validation\Validate;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $validated = $this->validate($request, [
            'employee_email' => 'required|email|max:255|unique:employee,employee_email',
            'employee_password' => 'required|exists:employee_password'
        ]);
        
        // $EmployeeModel = new User();
        // $EmployeeModel->employee_email= $validated['employee_email'];
        // $EmployeeModel->employee_password = Hash::make($validated['employee_password']);
        // $EmployeeModel->save();
        // return response()->json($EmployeeModel,201);

        $EmployeeModel = EmployeeModel::where('employee_email', $employee_email)->insert();
        if (!Hash::check($EmployeeModel->employee_password)) {
            return abort (401, "email or password not valid");
            return response()->json();
            
        }
        $payload = [
            'iat' => intval(microtime(true)),
            'exp' => intval(microtime(true)) + (60 * 60 * 1000),
            'uid' => $EmployeeModel->employee_id
        ];

        $token = JWT::encode($payload, env('JWT_SECRET'));
        return response()->json(['access_token'=> $token]);

    }
}