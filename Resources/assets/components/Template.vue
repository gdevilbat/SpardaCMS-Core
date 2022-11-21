<template>
	<div id="page">
	 <!-- begin:: Page -->
      <div class="m-grid m-grid--hor m-grid--root m-page">

        <!-- BEGIN: Header -->
        <header id="m_header" class="m-grid__item    m-header d-print-none" m-minimize-offset="200" m-minimize-mobile-offset="200">
          <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">

              <!-- BEGIN: Brand -->
              <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                  <div class="m-stack__item m-stack__item--middle m-brand__logo">
                    <a href="" class="m-brand__logo-wrapper">
                      <img v-if="settings.logo != ''" v-bind:src="settings.logo" alt="logo" class="img-logo">
                    </a>
                  </div>
                  <div class="m-stack__item m-stack__item--middle m-brand__tools">

                    <!-- BEGIN: Left Aside Minimize Toggle -->
                    <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                      <span></span>
                    </a>

                    <!-- END -->

                    <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                    <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                      <span></span>
                    </a>

                    <!-- END -->

                    <!-- BEGIN: Topbar Toggler -->
                    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                      <i class="flaticon-more"></i>
                    </a>

                    <!-- BEGIN: Topbar Toggler -->
                  </div>
                </div>
              </div>

              <!-- END: Brand -->
              <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">


                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                  <div class="m-stack__item m-topbar__nav-wrapper">
                    <ul class="m-topbar__nav m-nav m-nav--inline">
                      <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                       m-dropdown-toggle="click">
                        <a href="#" class="m-nav__link m-dropdown__toggle">
                          <span class="m-topbar__userpic">
                            <img src="../../../assets/images/atomix_user31.png" class="m--img-rounded m--marginless" alt="" />
                          </span>
                          <span class="m-topbar__username m--hide">{{user.name}}</span>
                        </a>
                        <div class="m-dropdown__wrapper">
                          <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                          <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center" style="">
                              <div class="m-card-user m-card-user--skin-dark">
                                <div class="m-card-user__pic">
                                  <img src="../../../assets/images/atomix_user31.png" class="m--img-rounded m--marginless" alt="" />
                                </div>
                                <div class="m-card-user__details">
                                  <span class="m-card-user__name m--font-weight-500">{{user.name}}</span>
                                  <a href="javascript:void(0)" class="m-card-user__email m--font-weight-300 m-link">{{user.email}}</a>
                                </div>
                              </div>
                            </div>
                            <div class="m-dropdown__body">
                              <div class="m-dropdown__content">
                                <ul class="m-nav m-nav--skin-light">
                                  <li class="m-nav__section m--hide">
                                    <span class="m-nav__section-text">Section</span>
                                  </li>
                                  <li class="m-nav__item">
                                    <a href="javascript:void(0)" class="m-nav__link">
                                      <i class="m-nav__link-icon flaticon-profile-1"></i>
                                      <span class="m-nav__link-title">
                                        <span class="m-nav__link-wrap">
                                          <span class="m-nav__link-text">My Profile</span>
                                        </span>
                                      </span>
                                    </a>
                                  </li>
                                  <li class="m-nav__separator m-nav__separator--fit">
                                  </li>
                                  <li class="m-nav__item">
                                    <a href="/control/auth/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

                <!-- END: Topbar -->
              </div>
            </div>
          </div>
        </header>

        <!-- END: Header -->

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

          <!-- BEGIN: Left Aside -->
          <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
          <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark d-print-none">

            <!-- BEGIN: Aside Menu -->
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
              <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow " v-html="sidebar">
				
              </ul>
             </div>

            <!-- END: Aside Menu -->
          </div>

          <!-- END: Left Aside -->
          <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
              <div class="d-flex align-items-center">
                <div class="mr-auto">
                  <h3 class="m-subheader__title m-subheader__title--separator">{{$route.meta.title_dashboard}}</h3>
				  <span v-html="breadcumb"></span>
                </div>
              </div>
            </div>

            <!-- END: Subheader -->
            <div class="m-content">

            <router-view name="content"></router-view>
             <loading
                        :is-full-page="true"
                        :active.sync="loading"/>

              <!--End::Section-->
            </div>
          </div>
        </div>

		<div class="modal fade" id="small" tabindex="-1" role="dialog" aria-hidden="true"  aria-labelledby="exampleModalLabel">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body"> 
						<h5 class="text-center">
							Are You Sure ?
						</h5>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary confirmed">Delete</button>
						<button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

        <!-- end:: Body -->

        <div class="loading-overlay h-100 w-100"></div>

        <!-- begin::Footer -->
        <footer class="m-grid__item   m-footer d-print-none">
          <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
              <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                <span class="m-footer__copyright">
                  2019 &copy; SpardaCMS by <a href="javascript:void(0)" class="m-link">gdevilbat</a>
                </span>
              </div>
            </div>
          </div>
        </footer>

        <!-- end::Footer -->
      </div>

      <!-- end:: Page -->

      <!-- begin::Scroll Top -->
      <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
      </div>

      <!-- end::Scroll Top -->
	</div>
</template>
<script>
    import Loading from 'vue-loading-overlay';

    export default {
        components: {
            Loading
        },
        props: {
        },
        data(){
            return{
              loading: false,
              sidebar: '',
              user : {
                'account': {}
              },
              breadcumb: '',
              settings: {
                logo: '',
                global: {
                  value:{
                    background:{
                      landscape: null,
                      portrait: null
                    }
                  }
                },
                pagination_count: null
              },
              vendor_bundle: this.$route.meta.APP_URL+"/metronic-v5/vendors/base/vendors.bundle.js",
              script_bundle: this.$route.meta.APP_URL+"/metronic-v5/demo/default/base/scripts.bundle.js",
            }
        },
        created() {
          let self = this;

          if(!this.isLoadedScript(self.vendor_bundle)){
            var doc = document.createElement('script');  
            doc.setAttribute('src',self.vendor_bundle);
            doc.setAttribute('type', 'text/javascript');
      
            doc.onload = function handleScriptLoaded() {
              if(!self.isLoadedScript(self.script_bundle)){
                var doc = document.createElement('script');  
                doc.setAttribute('src',self.script_bundle);
                doc.setAttribute('type', 'text/javascript');
                document.body.appendChild(doc);
              }
            };
      
            document.body.appendChild(doc);
          }

          // watch the params of the route to fetch the data again
          this.$watch(
            () => this.$route.params,
            (to, from) => {
              this.getSidebar()
              this.getSetting()
            },
            // fetch the data when the view is created and the data is
            // already being observed
            { immediate: true }
          )
        },
        mounted() {
          let self = this;
          axios({
            method : "post",
            url : "/control/account/me",
            }).then(Response=>{
              self.user = Response.data;
            }).catch(function(error){
          })
        },
        methods: {
          getSidebar(){
            let self = this;
            axios({
              method : "post",
              url : "/control/menu",
              }).then(Response=>{
                self.sidebar = Response.data;
              }).catch(function(error){
            })
          },
          getSetting(){
            let self = this;
            self.loading = true;
            axios({
              method : "post",
              url : "/control/setting",
              }).then(Response=>{
                self.settings = Response.data;
                self.loading = false;
              }).catch(function(error){
            })
          },
          isLoadedScript(lib){
            return document.querySelectorAll('[src="' + lib + '"]').length > 0
          },
          libSelector(lib){
            return document.querySelector('[src="' + lib + '"]')
          }
        },
    }
</script>
<style>
    @import 'vuetify/dist/vuetify.min.css';
    @import '../../../assets/metronic-v5/vendors/base/vendors.bundle.css';
    @import '../../../assets/metronic-v5/demo/default/base/style.bundle.css';
</style>
<style lang="scss">
	#main{
		height: 100%;
	}
</style>
<style lang="scss" scoped>
  @import 'vue-loading-overlay/dist/vue-loading.css';

	#page{
		height: 100%;
	}

	.m-page{
		height: 100%;
	}

	.m-dropdown__header{
		background: url(../../../assets/metronic-v5/app/media/img/misc/user_profile_bg.jpg); 
		background-size: cover;
	}

  .img-logo{
    max-width: 100%;
    height: auto;
  }

</style>