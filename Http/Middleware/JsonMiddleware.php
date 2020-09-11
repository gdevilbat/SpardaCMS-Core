<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class JsonMiddleware
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
        if (!$request->isMethod('post')) return $next($request);


        $acceptHeader = $request->header('Accept');
        if ($acceptHeader != 'application/json') {
            return response()->json(['message' => 'Only Json Accepted'], 406);
        }

        return $next($request);
    }
}
