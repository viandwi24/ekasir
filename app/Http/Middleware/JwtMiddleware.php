<?php
namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'error', 'error' => ['code'=>401,'text'=>'token.invalid']], 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'error', 'error' => ['code'=>401,'text'=>'token.expired']], 401);
            }else{
                return response()->json(['status' => 'error', 'error' => ['code'=>401,'text'=>'token.notfound']], 401);
            }
        }
        return $next($request);
    }
}