<?php

namespace App\Http\Controllers\Cms;

Use App\CredentialModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRolesModel;


class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index (Request $request)
    {
        $this->validate($request, [
            'secret_key' => 'required|min:4',
            'client_key' => 'required|min:4'
        ],
        [
            'secret_key.required' => 'Harap masukkan secret_key',
            'client_key.required' => 'Harap masukkan client_key'
        ]);

         
        $credentials = request([
            
            'secret_key' ,
            'client_key'
           
        ]);

        $CredentialsModel = CredentialsModel::where('secret_key', $request->secret_key)->first();
        if($CredentialsModel) {
            //do something
            if(Hash::check($request->client_key, $CredentialsModel->client_key)) {
                //do something
               return response()->json([
                   'data' => [
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