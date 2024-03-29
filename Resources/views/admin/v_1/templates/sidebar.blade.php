@can('menu-filemanager-core')
	<li class="m-menu__item  {{Route::current()->getName() == 'cms.filemanager.master' ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
	    <a href="{{route('cms.filemanager.master')}}" class="m-menu__link ">
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
@endcan
@can('super-access')
	<li class="m-menu__item  {{strstr(Route::current()->getName(), 'cms.module') ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
	    <a href="{{route('cms.module.master')}}" class="m-menu__link ">
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
@endcan
@can('menu-core')
	<li class="m-menu__item  {{strstr(Route::current()->getName(), 'cms.setting') ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
	    <a href="{{route('cms.setting.create')}}" class="m-menu__link ">
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