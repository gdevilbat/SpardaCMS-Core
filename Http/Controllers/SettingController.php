<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;
use Gdevilbat\SpardaCMS\Modules\Core\Entities\Setting as Setting_m;

use File;
use Validator;

class SettingController extends CoreController
{
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->data['admin_directories'] = $this->getDirectories('core:resources/views/admin');
        $this->data['public_directories'] = $this->getDirectories('core:resources/views/general');
        return view('core::admin.'.$this->data['theme_cms']->value.'.content.setting', $this->data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'pagination_count' => 'required',
            ]);

        $data = $request->except('_token', '_method','count_banner');

        foreach ($data as $key => $value) 
        {
            $length = strlen(json_encode($value));
            if($length > 65535)
            {
                $validator->errors()->add($key, $key.' Max Lenght 65,535 Characters');

                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
        }

        $settings = Setting_m::all();
        foreach ($data as $key => $value) 
        {
            $filtered = $settings->where('name', $key);
            if($filtered->count() > 0)
            {
                $setting = Setting_m::where('name', $key);
                if(!$setting->update(['value' => json_encode($value)]))
                {
                    return redirect()->back()->with('global_message',['status' => 400, 'message' => 'Failed To Update '.$key]);
                }
            }
            else
            {
                $setting = new Setting_m;
                $setting['name'] = $key;
                $setting['value'] = $value;
                if(!$setting->save())
                {
                    return redirect()->back()->with('global_message',['status' => 400, 'message' => 'Failed To Create '.$key]);
                }
            }
        }

        return redirect(action('\Gdevilbat\SpardaCMS\Modules\Core\Http\ControllersSettingController@create'))->with('global_message',['status' => 400, 'message' => 'Success To Update Setting']);
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
    public function destroy($id)
    {
        //
    }

    private function getDirectories($path)
    {
        $folder = collect(File::directories(module_asset_path($path)));
        $folder = $folder->map(function($item, $key){
                $array = explode("\\", str_replace("/","\\", $item));
                return end($array);
        });

        return $folder->toArray();
    }
}
