<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;

class FileManagerController extends CoreController
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function index()
    {
        return view('core::admin.'.$this->data['theme_cms']->value.'.content.filemanager', $this->data);
    }
}
