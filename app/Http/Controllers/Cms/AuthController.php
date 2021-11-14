<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmployeeModel;
use App\CredentialsModel;
use Illuminate\Support\Facades\Auth;

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
    //    dd($request->all());
        $this->validate($request, [
            'employee_email' => 'required|employee_email',
            'employee_password' => 'required'
        ]);
         
        $employee_email = $request->input('employee_email');
        $employee_password = $request->input('employee_password');
        $hashPassword = Hash::check($employee_password);
        $EmployeeModel = EmployeeModel::where("employee_email", $request->employee_email)->first();        

        if(!empty($EmployeeModel)){
            $payload = [
                'iat' => intval(microtime(true)),
                'exp' => intval(microtime(true)) + (60 * 60 * 1000),
                'uid' => $EmployeeModel->employee_id
            ];
            $secret_key = JWT::encode($payload, env('JWT_SECRET'));
            return response()->json([             
                'status' => 'succes',
                'secret_key' => $secret_key
                ]);  
        }
        
        return $data->json_decode($response,true);
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
            'access_token' => $secret_key,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

// class AuthController extends Controller
// {
//     public function login (Request $request)
//     {
        
//     } 
       
// }








  //     $EmployeeModel = EmployeeModel::where('employee_email' ,$employee_email)->first();
    //     if(!$EmployeeModel){
    //         return response()->json(['message' => 'Gagal Masuk'],401);
    //     }
    //     $isValidPassword = Hash::check($employee_password, $EmployeeModel->password);
    //     if(!$isValidPassword) {
    //         return response()->json(['message' => 'Gagal Masuk'],401);
    //     }
        
    //     $secret_key = bin2hex(random_bytes(40));
    //     $EmployeeModel->update([
    //         'secret_key' => $secret_key
    //     ]);

    //   return response()->json($EmployeeModel);
// $EmployeeModel = EmployeeModel::where("employee_email", $request->email)->first();
        
        // // // $EmployeeModel = EmployeeModel::find($employee_id);
        // // $EmployeeModel->employee_email = $request->get('employee_email');
        // // $EmployeeModel->employee_password = $request->get('employee_password');
        // if (Hash::check($request->input('employee_password', $EmployeeModel->employee_password))) {
        //     $apikey = base64_encode(str_random(40));
        //     EmployeeModel::where('employee_email', $request->input('employee_email'))->update(['api_key'=> "$apikey"]);
        //     return response()->json([
        //         'status'=> 'succes',
        //         'api_key'=> $apikey
        //     ]);  
        // }
        // else {
        //     return response()->json(['status'=> 'fail'],401);
        // }

        // if($EmployeeModel){
        //     Auth::login($EmployeeModel);
        // }

        
        

    // }
