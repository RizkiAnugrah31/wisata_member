<?php

namespace App\Http\Controllers\Cms;

Use App\EmployeeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRolesModel;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index (Request $request)
    {
        $this->validate(
            $request,
            [
                'employee_username' => 'required|string|max:255',
                'employee_email'    => 'required|string|email|max:255|unique:EmployeeModel|same:email',
                'employee_password' => 'required|string|max:255',
                'employee_password_confirmation' => 'required|same:password'

            ],
            [
                'employee_username.required'      => 'Username wajib diisi.',
                'employee_password.required'      => 'Password wajib diisi.',
                'employee_password_confirmation.required'  => 'Harap konfirmasi password.',
                'employee_password_confirmation.same'      => 'Password tidak sesuai.',
                'employee_email.required'         => 'Email wajib diisi.',
                'employee_email.email'            => 'Email tidak valid.',
                'employee_email.unique'           => 'Email sudah terdaftar.',
                'employee_email.same'             => 'Email sudah terkonfirmasi.'
            ]
        );
        EmployeeModel::create([
            'employee_username' => $request->employee_username,
            'employee_role' => $request->user_roles_status,
            'employee_email' => $request->employee_email,
            'employee_password' => Hash::make($request->employee_password)
        ]);


        $EmployeeModel = EmployeeModel::where('email', $request->employee_email)->first();

        $secret_key = auth()->attempt($request->only('employee_email', 'employee_password'));

        return ResponseFormatter::success([
            'access_token' => $secret_key,
            'token_type' => 'Bearer',
            'user' => $EmployeeModel
        ], 'Pengguna berhasil terdaftar');
    }
    
}