<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;

use Rinvex\Menus\Models\MenuItem;
use Rinvex\Menus\Models\MenuGenerator;

use Gdevilbat\SpardaCMS\Modules\Core\Entities\Module as Module_m;

use View;
use Log;
use App;

class MenuController extends CoreController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getMenu()
    {
        $menu = null;
        $modules = Module_m::where('is_scanable', '=', '1')->orderBy('order')->get();

        try {
            $menu .= View('admin.'.$this->data['theme_cms']->value.'.content.sidebar')->render();
        } catch (\InvalidArgumentException $e) {
            
        }

        foreach ($modules as $module) 
        {
            try {
                $menu .= View($module->slug.'::admin.'.$this->data['theme_cms']->value.'.content.sidebar')->render();
            } catch (\InvalidArgumentException $e) {
                if(!App::environment('production'))
                {
                    throw new \Gdevilbat\SpardaCMS\Modules\Core\Exceptions\ManualHandler('Sidebar Not Found On Module '.$module->name);
                }
                else
                {
                    Log::info('Sidebar Not Found On '.$module->name);
                }
            }
        }

        return $menu;
    }
}
