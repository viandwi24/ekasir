<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;

class AuthPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $checkPermit = auth()->user()->hasPermissionTo($permission);
        if (!$checkPermit) return response()->json(['status' => 'error', 'error' => ['code'=>403,'text'=>'permission.forbidden']], 403);
        return $next($request);
    }
}
