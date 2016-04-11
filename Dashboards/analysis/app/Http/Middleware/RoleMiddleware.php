<?php
/**
 * Created by PhpStorm.
 * User: sergey@slepokurov.com
 * Date: 11.04.2016
 * Time: 12:52
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('auth.login'));
            }
        }

        return $next($request);
    }

}