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
    public function __construct()
    {
        parent::__construct();
        $this->setting_m = new Setting_m;
        $this->setting_repository = new Repository(new Setting_m, resolve(\Gdevilbat\SpardaCMS\Modules\Role\Repositories\Contract\AuthenticationRepository::class));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->data['admin_directories'] = $this->getDirectories('core:Resources/views/admin');
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

        $settings = $this->setting_repository->all();
        foreach ($data as $key => $value) 
        {
            $filtered = $settings->where('name', $key);
            if($filtered->count() > 0)
            {
                $setting = $this->setting_m->where('name', $key);
                if(!$setting->update(['value' => json_encode($value)]))
                {
                    if($request->ajax()){
                        return response()->json([
                            'status' => true,
                            'message' => 'Failed To Update '.$key,
                            'code' => 400
                        ]);
                    }else{
                        return redirect()->back()->with('global_message',['status' => 400, 'message' => 'Failed To Update '.$key]);
                    }
                }
            }
            else
            {
                $setting = new $this->setting_m;
                $setting['name'] = $key;
                $setting['value'] = $value;
                if(!$setting->save())
                {
                    if($request->ajax()){
                        return response()->json([
                            'status' => true,
                            'message' => 'Failed To Create '.$key,
                            'code' => 400
                        ]);
                    }else{
                        return redirect()->back()->with('global_message',['status' => 400, 'message' => 'Failed To Update '.$key]);
                    }
                }
            }
        }

        if($request->ajax()){
            return response()->json([
                'status' => true,
                'message' => 'Success To Update Setting',
                'code' => 200
            ]);
        }else{
            return redirect()->back()->with('global_message',['status' => 200, 'message' => 'Success To Update Setting']);
        }

    }

    public function setting(Request $request)
    {
        return response()->json([
            'logo' => empty($this->data['settings']->where('name','global')->flatten()->first()->value['logo']) ? module_asset_url('Core:assets/images/Spartan.png') : generate_storage_url($this->data['settings']->where('name','global')->flatten()->first()->value['logo']),
            'global' => !empty($this->data['settings']->where('name','global')->flatten()->first()) ? $this->data['settings']->where('name','global')->flatten()->first() : [
                    'value' => [
                        'background' => [
                            'landscape' => null,
                            'portrait' => null,
                        ],
                        'favicon' => null,
                        'fb_share_description' => null,
                        'fb_share_image' => null,
                        'fb_share_title' => null,
                        'google_site_verification' => null,
                        'logo' => null,
                        'maintenance_image' => null,
                        'meta_description' => null,
                        'meta_title' => null,
                        'not_found_image' => null,
                    ]
                ],
            'pagination_count' => empty($this->data['settings']->where('name','pagination_count')->flatten()->first()) ? null : $this->data['settings']->where('name','pagination_count')->flatten()->first()->value
        ]);
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
