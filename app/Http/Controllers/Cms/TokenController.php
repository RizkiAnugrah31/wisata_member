<?php

namespace App\Http\Controllers\Cms;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\CredentialsModel;


class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login (Request $request)
    {
        $this->validate($request, [
            'secret_key' => 'required|min:4',
            'client_key' => 'required|min:4'
        ],
        [
            'secret_key.required' => 'Harap masukkan secret_key',
            'client_key.required' => 'Harap masukkan client_key'
        ]);

         
        $data = request([
            
            'secret_key' ,
            'client_key'
           
        ]);

        // dd($data);
        $CredentialsModel = CredentialsModel::where('secret_key', $request->secret_key)->first();
        if($CredentialsModel) {
            //do something
            if(Hash::check($request->client_key, $CredentialsModel->client_key)) {
                //do something
               return response()->json([
                   'data' => [
                       'credential_id' => $CredentialsModel->credential_id,
                       'platfrom' => $CredentialsModel->platform
                   ],
                   'message' => 'Valid',
                   'success' => true
               ]);
             }
        } 
        
           return response()->json([
               'message' => 'Data Tidak Valid',
               'succes' => false,
               'data' => new \stdClass()
           ]);

    }
    
}