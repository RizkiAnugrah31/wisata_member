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
        $validator = Validator::make($request->all(),
        [
            'secret_key' => 'required|min:4',
            'client_key' => 'required|min:4'
        ],
        [
            'secret_key.required' => 'Harap masukkan secret_key',
            'client_key.required' => 'Harap masukkan client_key'
        ]);

        if($validator->fails()) {
            return response()->json([
                'data' => new \stdClass(),
                'message'=> implode('',$validator->getMessageBag()->all()),
                'success'=> false
            ]);
        }
         
        $data = request([
            
            'secret_key' ,
            'client_key'
           
        ]);

        // dd($data);
        $CredentialsModel = CredentialsModel::where('client_key', $request->client_key)->first();
        if($CredentialsModel) {
            //do something
            if(Hash::check($request->secret_key, $CredentialsModel->secret_key)) {
                //do something
               return response()->json([
                   'data' => [
                       'credential_id' => $CredentialsModel->credential_id,
                       'platform' => $CredentialsModel->platform
                   ],
                   'message' => 'Data Valid',
                   'success' => true
               ]);
             }
        } 
        
           return response()->json([
               'message' => 'Token Service Membership Gagal Mendapatkan Data',
               'success' => false,
               'data' => new \stdClass()
           ]);

    }
    
}