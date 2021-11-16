<?php

namespace App\Http\Controllers\Cms;

Use App\EmployeeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index (Request $request)
    {
        $this->validate($request, [
            'employee_email' =>'required|unique:users,employee_email',
            'employee_password' => 'required|confirmed'
        ]);

        $employee_email = $request->input('employee_email');
        $employee_password = Hash::make($request->input('password'));
        
        User::create(['employee_email'=> $employee_email, 'employee_password' => $employee_password ]);

        return response()->json(
            ['status' => 'success',
            'operation' => 'created']);
    }
}