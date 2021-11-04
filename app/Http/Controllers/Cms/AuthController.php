<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmployeeModel;
use App\CredentialModel;


class AuthController extends Controller
{
    public function login (Request $request)
    {
        $this->validate($request, [
            'employee_email' => 'required|email',
            'employee_password' => 'required'
        ]);
         
        $employee_email = $request->input('employee_email');
        $employee_password = $request->input('employee_password');
        $hashPassword = Hash::make($employee_password);

        $EmployeeModel = EmployeeModel::where("employee_email", $request->email)->first();

        return response()->json();
        $payload = [
            'iat' => intval(microtime(true)),
            'exp' => intval(microtime(true)) + (60 * 60 * 1000),
            'uid' => $EmployeeModel->employee_id
        ];

        if(!empty($EmployeeModel)){
            // dd($request->all());
            Auth::login($EmployeeModel);
            $secret_key = JWT::encode($payload, env('JWT_SECRET'));
            EmployeeModel::where('employee_email', $request->input('employee_email'))->update(['secret_key'=> "$secret_key"]);
            return response()->json([
                'status'=> 'succes',
                'secret_key'=> $secret_key
            ]);  
        }
        return response()->json(); 
    } 
       
}








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
