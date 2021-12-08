<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmployeeModel;
use App\CredentialsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;
use App\Helpers\ResponseFormatter;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
      * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        
       $validator = Validator::make($request->all(), 
       [
            'employee_email' => 'required|min:4',
            'employee_password' => 'required|min:4'
        ],
        [
            'employee_email.required' => 'Harap masukkan email',
            'employee_password.required' => 'Harap masukkan password'
        ]);

        if($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message'=> implode('',$validator->getMessageBag()->all()),
                'success'=> false
            ]);
        }
         
        $credentials = request([
            
            'employee_email' ,
            'employee_password'
           
        ]);

        $EmployeeModel = EmployeeModel::where('employee_email', $request->employee_email)->first();
             if($EmployeeModel) {
                 //do something
                 if(Hash::check($request->employee_password, $EmployeeModel->employee_password)) {
                     //do something
                if($EmployeeModel){
                    return response()->json([
                        'data' => [
                            'employee_id' => $EmployeeModel->employee_id,
                            'employee_firstname' => $EmployeeModel->employee_firstname,
                            'employee_middlename' => $EmployeeModel->employee_middlename,
                            'employee_lastname' => $EmployeeModel->employee_lastname,
                            'employee_username' => $EmployeeModel->employee_username,
                            'employee_image' => $EmployeeModel->employee_image
                        ],
                        'message' => 'Valid',
                        'success' => true
                    ]);
                  }
                
                return response()->json([
                    'message' => 'Employee Service Membership Gagal Mendapatkan Data',
                    'success' => false,
                    'data' => new \stdClass()
                ]);
            }
        
        }
    }
    
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->EmployeeModel());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response
        ()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'secret_key' => $secret_key,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

