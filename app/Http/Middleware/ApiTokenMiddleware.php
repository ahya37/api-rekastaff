<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ResponseFormatter;
use App\Models\TokenManagement;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (empty($token)) {
           return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => 'Authorization Header is empty'
             ]);
        }

        // format bearer token
        $split_token = explode(" ", $token);
        if (count($split_token) <> 2) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => 'Invalid Authorization format'
             ]);
        }

        if (trim($split_token[0]) <> 'Bearer') {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => 'Authorization header must be a Bearer'
             ]);
        }

        $access_token =  trim($split_token[1]);

        // cek ketersediaan token
        $cek = TokenManagement::where('access_token', $access_token)->first();
        if (empty($cek)) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => 'Forbidden : Invalid access token'
             ]);
        }

        // cek expired token
        if (strtotime($cek->expired_at) <  time() || $cek->is_active != 1) {
           return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => 'Forbidden : Token is already expired. '
             ]);
        }
        
        return $next($request);
    }
}
