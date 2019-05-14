<li class="m-menu__item  {{url()->full() == action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index') ? 'm-menu__item--active' : ''}}" aria-haspopup="true"}>
    <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index')}}" class="m-menu__link ">
        <i class="m-menu__link-icon flaticon-cogwheel"></i>
        <span class="m-menu__link-title"> 
            <span class="m-menu__link-wrap"> 
                <span class="m-menu__link-text">
                    Module
                </span>
             </span>
         </span>
     </a>
</li>
<li class="m-menu__item  {{url()->full() == action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create') ? 'm-menu__item--active' : ''}}" aria-haspopup="true"}>
    <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create')}}" class="m-menu__link ">
        <i class="m-menu__link-icon flaticon-squares-4
"></i>
        <span class="m-menu__link-title"> 
            <span class="m-menu__link-wrap"> 
                <span class="m-menu__link-text">
                    Setting
                </span>
             </span>
         </span>
     </a>
</li>