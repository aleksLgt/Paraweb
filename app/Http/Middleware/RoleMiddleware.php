<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $uri    =   $request->getRequestUri();
        $method =   $request->getMethod();

        $params =   strpos($uri,'?');

        if ($params) {
            $uri = substr($uri,0,$params);
        }

        $uriArray = explode('/',$uri);
        foreach ($uriArray as $uriPart) {
            if ((int)$uriPart != 0) {
                $uri = str_replace($uriPart,'%',$uri);
            }
        }

        $userId = Auth::id();
        $userRoles = User::find($userId)->roles;
        $isAvailableRoute = false;
        foreach ($userRoles as $userRole) {
            $isExists = $userRole->permissions()
                ->where('uri', 'LIKE', $uri)
                ->where('method', '=', $method)
                ->exists();
            if ($isExists) {
                $isAvailableRoute = true;
            };
        }

        if ($isAvailableRoute) {
            return $next($request);
        }

        return response()->json('Недостаточно прав!',Response::HTTP_FORBIDDEN);
    }
}
