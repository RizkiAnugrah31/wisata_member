<?php

namespace App\Http\Controllers\Cms;

Use App\EmployeeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indek ($id)
    {
        $validator = Validator::make($request->all, [
            'employee_username'=> 'required',
            'employee_email' => 'required|string|email|unique::users',
            'employee_password' => 'required|string|confirmed|min:6'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password'=>bcrypt($request->password)]

        ));
        return response()->json([
            'message'=>'User Success!',
            'user'=> $user
        ],201);

        
    }
}