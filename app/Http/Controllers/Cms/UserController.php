<?php

namespace App\Http\Controllers\Cms;

Use App\EmployeeModel;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $user = EmployeeModel::find($id);
        if ($user)
        {
            return response()->json([
                'success' => true,
                'message' => 'User Found!',
                'data' => $user
            ], 200);
        } 
        else 
        {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found!',
                'data' => ''
            ], 404);
        }
    }
}