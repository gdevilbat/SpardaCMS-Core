<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware;

use Closure;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as MaintenanceMode;
use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;

use Module;

class CheckForMaintenanceMode extends CoreController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $app;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'control/*',
        'login'
    ];

    public function __construct(Application $app)
    {
    	parent::__construct();
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance() && !$this->inExceptArray($request) && !(Auth::check())) 
        {
        	if(Module::has('Appearance'))
        	{
        		return response()
                ->view('appearance::general.'.$this->data['theme_public']->value.'.errors.503', $this->data, 503);
        	}
        	else

        	{
	            abort(503);
        	}
        }
        return $next($request);
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
