<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use  Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;
use Gdevilbat\SpardaCMS\Modules\Core\Entities\Module as Module_m;

use Module;

class ModuleController extends CoreController
{
    public function __construct()
    {
        parent::__construct();
        $this->module_m = new Module_m;
        $this->module_repository = new Repository(new Module_m);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $core_modules = collect(Module::allEnabled())->keys();
        $core_modules = $core_modules->map(function($item, $key){
                          return str_slug($item);  
                        });

        $modules = $this->module_m->select('slug')->pluck('slug');

        $add_modules = $core_modules->diff($modules)->flatten();
        $remove_modules = $modules->diff($core_modules)->flatten();

        foreach ($add_modules as $key => $value) 
        {
            $module = $this->module_m;
            $module->name = title_case(str_replace('-', ' ', $value));
            $module->slug = $value;
            $module->description = '';
            $module->save();
        }

        $this->module_m->whereIn('slug', $remove_modules)->delete();

        $this->data['modules'] = $this->module_repository->all();

        return view('core::admin.'.$this->data['theme_cms']->value.'.content.Module.master', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->data['method'] = method_field('POST');
        if(isset($_GET['code']))
        {
            $this->data['module'] = $this->module_repository->findOrFail(decrypt($_GET['code']));
            $this->data['method'] = method_field('PUT');
        }

        return view('core::admin.'.$this->data['theme_cms']->value.'.content.Module.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'name' => 'required|max:50',
                'scope' => 'max:191',
            ]);

        if($request->isMethod('POST'))
        {
            $this->validate($request,[
                'slug' => 'required|max:191|unique:module',
            ]);
            $data = $request->except(['_token','_method']);
            $module = new $this->module_m;
        }
        else
        {
             $this->validate($request,[
                'slug' => 'required|max:191|unique:module,slug,'.decrypt($request->input('id')).',id',
            ]);
            $data = $request->except(['_token','_method', 'id']);
            $module = $this->module_repository->findOrFail(decrypt($request->input('id')));
        }

        foreach ($data as $key => $value) 
        {
            $module->$key = $value;
        }

        if(!$request->has('scope'))
            $module->scope = array();

        if($module->save())
        {
            if($request->isMethod('POST'))
            {
                return redirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))->with('global_message', array('status' => 200,'message' => 'Successfully Add Module!'));
            }
            else
            {
                return redirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index'))->with('global_message', array('status' => 200,'message' => 'Successfully Update Module!'));
            }
        }
        else
        {
            if($request->isMethod('POST'))
            {
                return redirect()->back()->with('global_message', array('status' => 400, 'message' => 'Failed To Add Module!'));
            }
            else
            {
                return redirect()->back()->with('global_message', array('status' => 400, 'message' => 'Failed To Update Module!'));
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('core::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $query = $this->module_repository->findOrFail(decrypt($request->id));

        $module = Module::find($query->slug);

        try {
            $module->disable();

            return redirect()->back()->with('global_message', array('status' => 200,'message' => 'Successfully Delete Module!'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('global_message', array('status' => 200,'message' => 'Failed Delete Module, It\'s Has Been Used!'));
        }
    }
}