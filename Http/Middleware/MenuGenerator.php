<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\MenuController;

class MenuGenerator
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
        $menu = new MenuController;
        $menu = $menu->getMenu();

        \View::share(
                [
                'menu' => $menu,
            ]
        );

        return $next($request);
    }
}
