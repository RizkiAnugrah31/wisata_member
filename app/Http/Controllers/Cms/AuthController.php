<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmployeeModel;
use Firebase\JWT\JWT;
use Illuminate\Validation\Validator;


class AuthController extends Controller
{
    public function login (Request $request)
    {
        $validated = $this->validate($request, [
            'employee_email' => $employee_email,
            'employee_password' => $employee_password
        ]);

        $EmployeeModel = EmployeeModel::where('employee_email', $validated['employee_email'])->first();
        if (!Hash::make($validated['employee_password'], $EmployeeModel->employee_password)) {
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