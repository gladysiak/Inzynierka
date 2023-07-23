<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $groupId = $request->route('group')->id; // pobranie id grupy z parametru routy
        $user = auth()->user(); // pobranie zalogowanego użytkownika

        if ($user->isAdmin() || $user->adminGroups()->where('id', $groupId)->exists()) {
            return $next($request);
        }

        return $next($request);
    }
}
