<div class="app-sidebar-menu d-flex flex-center overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper d-flex hover-scroll-overlay-y my-5"
        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu, #kt_app_sidebar" data-kt-scroll-offset="5px" style="height: 245px;">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-active-bg menu-title-gray-700 menu-arrow-gray-500 menu-icon-gray-500 menu-bullet-gray-500 menu-state-primary my-auto"
            id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
            <!--begin:Menu item-->
            <a href="{{ route('dashboard') }}" data-kt-menu-placement="right-start"
                class="menu-item py-2 @if (Route::currentRouteName() == 'dashboard') here @endif">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fonticon-house fs-1"></i>
                    </span>
                </span>
                <!--end:Menu link-->
            </a>
            <!--end:Menu item-->

            <!--begin:Menu item-->
            <a href="{{ route('clients') }}" data-kt-menu-placement="right-start"
                class="menu-item py-2 @if (Route::currentRouteName() == 'clients') here @endif">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="fonticon-stats fs-1"></i>
                    </span>
                </span>
                <!--end:Menu link-->
            </a>
            <!--end:Menu item-->

            @can('admin.show')
                <!--begin:Menu item-->
                <a href="{{ route('admin') }}" data-kt-menu-placement="right-start"
                    class="menu-item py-2 @if (Route::currentRouteName() == 'admin') here @endif">
                    <!--begin:Menu link-->
                    <span class="menu-link menu-center">
                        <span class="menu-icon me-0">
                            <i class="fonticon-layers fs-1"></i>
                        </span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
            @endcan

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
