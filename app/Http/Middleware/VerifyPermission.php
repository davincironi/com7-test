<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $level = $request->user()->level;
        $actionName = $request->route()->getActionMethod();
        if ($level == 'viewer' && !in_array($actionName, ['index', 'show'])) {
            abort(403);
        }
        if ($level == 'editor' && !in_array($actionName, ['index', 'show', 'edit', 'update'])) {
            abort(403);
        }
        return $next($request);
    }
}
