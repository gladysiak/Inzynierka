<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $user = Auth::user();
        $groupId = $request->route('group') ? $request->route('group')->id : null;

        if ($user && ($user->roles()->whereIn('name', $roles)->exists() || $this->isGroupAdmin($user, $groupId))) {
            return $next($request);
        }

        abort(403, 'Brak dostępu.');
    }

    private function isGroupAdmin($user, $groupId)
    {
        return $user->adminGroups()->where('id', $groupId)->exists();
    }
}
