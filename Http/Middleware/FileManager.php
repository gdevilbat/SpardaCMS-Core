<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class FileManager
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->uri();

        $user = $request->user();

        // if ( $routeName === 'file-manager/delete' && $user->id === 1) OR
        // if ($routeName === 'file-manager/delete' && $user->role !== admin) OR
        // if ($routeName === 'file-manager/delete' && something else...)

        if ($routeName === 'file-manager/tree' &&  !(Auth::user()->can('menu-filemanager-core'))) {
            abort(403);
        }

        if($routeName === 'file-manager/delete') {
            if(Auth::user()->can('full-control-filemanager-core'))
                return $next($request);

            if(Auth::user()->can('restrict-delete-filemanager-core'))
                abort(403);

            if(Auth::user()->can('read-write-filemanager-core'))
            {
                if(Auth::user()->can('delete-filemanager-core'))
                    return $next($request);

                $url_path = collect(explode('/', $request->input('items.0.path')));

                if($url_path->first() == 'shares')
                	return $next($request);

                if($url_path->first() == 'users' && $url_path->get(1) == Auth::id())
                	return $next($request);

                abort(403);
            }
        }

        return $next($request);
    }
}
