<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ColocationRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()){
            abort(403);
        }
        $user = Auth::user();
        $colocationId = $request->route('colocation')->id;

        $membership = $user->colocations()->wherePivot('colocation_id', $colocationId)->wherePivotNull('left_at')->first();

        if(!$membership || $membership->pivot->role !== $role){
            abort(403);
        }
        return $next($request);
    }
}
