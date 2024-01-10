<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('id', $request->get('user_id'))->where('token', $request->bearerToken())->first();
        if(!$user) {
            $responseData = [
                'error' => [
                    'code' => 401,
                    'message' => 'Invalid user token'
                ]
            ];

            return response()->json($responseData);
        }
        
        return $next($request);
    }
}
