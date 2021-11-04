<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            if ($request->has('secret_key')){
                $secret_key = $request->input('secret_key');
                $secret_key = CredentialModel::where('secret_key', $secret_key)->first();
                if($secret_key == null) {
                    $response['success'] = false;
                    $response['message'] = 'Permission not Allowed';

                    return response($response) -> json();
                }
            }else{
                $response['success'] = true;
                $response['message'] = 'Login please!';

                return response($response) -> json();
            }
            
            
        }

        
    }
}
