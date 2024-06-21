<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$accessLevel)
    {
        $user = $request->user();
        $accessLevel = 'REGISTER';
        // Ensure the user is authenticated and has a role
        if (!$user || !$user->ref_role) {
            abort(403, 'No role found or user not authenticated.');
        }

        $permissions = explode(',', $user->ref_role->role_access);
        dd()
        // Check if the required access level is in the permissions array or if 'all' is present
        if (!in_array($accessLevel, $permissions) && !in_array('ALL', $permissions)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
