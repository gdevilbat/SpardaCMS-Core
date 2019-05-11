<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        \Menu::create('test', function($menu) {
            $menu->url('/', 'Home');
            $menu->dropdown('Settings', function ($sub) {
                $sub->url('settings/account', 'Account');
                $sub->url('settings/password', 'Password');
                $sub->url('settings/design', 'Design');
            });
        });
        return $next($request);
    }
}
