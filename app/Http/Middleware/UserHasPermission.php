<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Caffeinated\Shinobi\Middleware\UserHasPermission as BaseUserHasPermission;

class UserHasPermission extends BaseUserHasPermission
{
    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $closure
     * @param array|string             $permissions
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        if ($this->auth->check())
        {
            if (!$this->auth->user()->can($permissions))
            {
                if ($request->ajax())
                {
                    return response()->json(['message' => '¡Acción no autorizada!'], 403);
                }

                abort(403, 'Unauthorized action.');
            }
        }
        else
        {
            $guest = Role::whereSlug('guest')->first();

            if ($guest)
            {
                if (!$guest->can($permissions))
                {
                    if ($request->ajax())
                    {
                        return response()->json(['message' => '¡Acción no autorizada!'], 403);
                    }

                    abort(403, 'Unauthorized action.');
                }
            }
        }

        return $next($request);
    }
}
