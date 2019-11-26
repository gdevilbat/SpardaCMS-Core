@can('super-access')
	<li class="m-menu__item  {{Route::current()->getName() == 'filemanager' ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
	    <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\FileManagerController@index')}}" class="m-menu__link ">
	        <i class="m-menu__link-icon flaticon-symbol"></i>
	        <span class="m-menu__link-title"> 
	            <span class="m-menu__link-wrap"> 
	                <span class="m-menu__link-text">
	                    File Manager
	                </span>
	             </span>
	         </span>
	     </a>
	</li>
	<li class="m-menu__item  {{Route::current()->getName() == 'cms.module.master' ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
	    <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\ModuleController@index')}}" class="m-menu__link ">
	        <i class="m-menu__link-icon flaticon-squares-4"></i>
	        <span class="m-menu__link-title"> 
	            <span class="m-menu__link-wrap"> 
	                <span class="m-menu__link-text">
	                    Module
	                </span>
	             </span>
	         </span>
	     </a>
	</li>
	<li class="m-menu__item  {{Route::current()->getName() == 'cms.setting.create' ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
	    <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\SettingController@create')}}" class="m-menu__link ">
	        <i class="m-menu__link-icon flaticon-cogwheel"></i>
	        <span class="m-menu__link-title"> 
	            <span class="m-menu__link-wrap"> 
	                <span class="m-menu__link-text">
	                    Setting
	                </span>
	             </span>
	         </span>
	     </a>
	</li>
@endcan