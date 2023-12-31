<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="{{url('/')}}" class="logo logo-large"><img src="{{asset('/uploads/'.$settings['logo'])}}" style="width:70px; height:70px;" class="img-fluid" alt="logo"></a>
            <a href="{{url('/')}}" class="logo logo-small"><img src="{{asset('/uploads/'.$settings['logo'])}}"style="width:70px; height:70px;" width="100" height="100" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End Logobar -->
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
                <li>
                    <a href="index.html">
                        <i class="ri-user-6-fill"></i><span>CRM</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard-ecommerce.html">
                        <i class="ri-store-2-fill"></i><span>E-Commerce</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard-hospital.html">
                        <i class="ri-hospital-fill"></i><span>Hospital</span>
                    </a>
                </li>
                <li class="vertical-header"></li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pencil-ruler-line"></i><span>Basic UI</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="basic-ui-kits-alerts.html">Alerts</a></li>
                        <li><a href="basic-ui-kits-badges.html">Badges</a></li>
                        <li><a href="basic-ui-kits-buttons.html">Buttons</a></li>
                        <li><a href="basic-ui-kits-cards.html">Cards</a></li>
                        <li><a href="basic-ui-kits-carousel.html">Carousel</a></li>
                        <li><a href="basic-ui-kits-collapse.html">Collapse</a></li>
                        <li><a href="basic-ui-kits-dropdowns.html">Dropdowns</a></li>
                        <li><a href="basic-ui-kits-embeds.html">Embeds</a></li>
                        <li><a href="basic-ui-kits-grids.html">Grids</a></li>
                        <li><a href="basic-ui-kits-images.html">Images</a></li>
                        <li><a href="basic-ui-kits-media.html">Media</a></li>
                        <li><a href="basic-ui-kits-modals.html">Modals</a></li>
                        <li><a href="basic-ui-kits-paginations.html">Paginations</a></li>
                        <li><a href="basic-ui-kits-popovers.html">Popovers</a></li>
                        <li><a href="basic-ui-kits-progressbars.html">Progress Bars</a></li>
                        <li><a href="basic-ui-kits-spinners.html">Spinners</a></li>
                        <li><a href="basic-ui-kits-tabs.html">Tabs</a></li>   
                        <li><a href="basic-ui-kits-toasts.html">Toasts</a></li>     
                        <li><a href="basic-ui-kits-tooltips.html">Tooltips</a></li>
                        <li><a href="basic-ui-kits-typography.html">Typography</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pencil-ruler-2-line"></i><span>Advanced UI</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">                                
                        <li><a href="advanced-ui-kits-image-crop.html">Image Crop</a></li>  
                        <li><a href="advanced-ui-kits-jquery-confirm.html">jQuery Confirm</a></li>
                        <li><a href="advanced-ui-kits-nestable.html">Nestable</a></li>
                        <li><a href="advanced-ui-kits-pnotify.html">Pnotify</a></li>
                        <li><a href="advanced-ui-kits-range-slider.html">Range Slider</a></li>
                        <li><a href="advanced-ui-kits-ratings.html">Ratings</a></li>
                        <li><a href="advanced-ui-kits-session-timeout.html">Session Timeout</a></li>
                        <li><a href="advanced-ui-kits-sweet-alerts.html">Sweet Alerts</a></li>
                        <li><a href="advanced-ui-kits-switchery.html">Switchery</a></li>
                        <li><a href="advanced-ui-kits-toolbar.html">Toolbar</a></li>
                        <li><a href="advanced-ui-kits-tour.html">Tour</a></li>
                        <li><a href="advanced-ui-kits-treeview.html">Tree View</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                      <i class="ri-apps-line"></i><span>Apps</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="apps-calender.html">Calender</a></li>
                        <li><a href="apps-chat.html">Chat</a></li> 
                        <li>
                            <a href="javaScript:void();">Email<i class="ri-arrow-right-s-line"></i></a>
                            <ul class="vertical-submenu">
                                <li><a href="apps-email-inbox.html">Inbox</a></li>
                                <li><a href="apps-email-open.html">Open</a></li>
                                <li><a href="apps-email-compose.html">Compose</a></li>
                            </ul>
                        </li>
                        <li><a href="apps-kanban-board.html">Kanban Board</a></li>
                        <li><a href="apps-onboarding-screens.html">Onboarding Screens</a></li>
                    </ul>
                </li>
                {{-- @if(auth()->user()->can('compression_worker'))                      
                <li>
                    <a href="{{route('squeeze.index')}}">
                        <i class="ri-hospital-fill"></i><span>@lang('lang.compression')</span>
                    </a>
                </li>
                @endif --}}
                @if(auth()->user()->can('compression_worker'))
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-file-copy-2-line"></i><span>{{__('lang.compression')}}</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{route('squeeze.index')}}">@lang('lang.compression_request_form_admin')</a></li>
                        <li><a href="{{route('tying-bales.index')}}">@lang('lang.tying_bales')</a></li>
                    </ul>
                </li>
                @endif
                @if(auth()->user()->can('transporter'))                      
                <li>
                    <a href="{{route('transporter.index')}}">
                        <i class="ri-hospital-fill"></i><span>@lang('lang.transport_worker')</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('orignal_store_worker'))
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-file-copy-2-line"></i><span>{{__('lang.original_store_worker')}}</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        {{-- <li><a href="{{route('original-store-worker.fill')}}">@lang('lang.filling')</a></li> --}}
                        <li><a href="{{route('original-store-worker-filling.index')}}">@lang('lang.filling')</a></li>
                        <li><a href="{{route('original-store-worker.index')}}">@lang('lang.store_worker_recieve_original')</a></li>
                        <li><a href="{{route('recieve-shipment-from-supplier.index')}}">@lang('lang.recieve_shipment_from_supplier')</a></li>
                        <li><a href="{{route('filling-admin-requests.index')}}">@lang('lang.filling_admin_requests')</a></li>
                        <li><a href="form-layouts.html">Layouts</a></li>
                    </ul>
                </li>
                @endif
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-file-copy-2-line"></i><span>{{__('lang.admin_requests')}}</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{route('admin_opening_request.index')}}">@lang('lang.opening_request')</a></li>
                    </ul>
                    <ul class="vertical-submenu">
                        <li><a href="{{route('admin_filling_request.index')}}">@lang('lang.filling_request')</a></li>
                       
                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pie-chart-line"></i><span>@lang('lang.stock')</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{route('original-stock-create')}}">@lang('lang.original_stock')</a></li>
                        <li><a href="chart-c3.html">@lang('lang.original_stock_from_store')</a></li>
                    </ul>
                </li>
                @if(auth()->user()->can('employees_module.employee.view'))
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-service-line"></i><span>@lang('lang.employees')</span><i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{route('employees.index')}}">@lang('lang.employees')</a></li>
                        @if(auth()->user()->can('employees_module.jobs.view'))
                        <li><a href="{{route('jobs.index')}}">@lang('lang.jobs')</a></li>
                        @endif
                        @if(auth()->user()->can('employees_module.leave_types.view'))
                        <li><a href="{{route('leave_types.index')}}">@lang('lang.vacation_types')</a></li>
                        @endif
                        @if(auth()->user()->can('employees_module.wages.view'))
                        <li><a href="{{route('wages.index')}}">@lang('lang.wages')</a></li>
                        @endif
                        @if(auth()->user()->can('employees_module.attendance.view'))
                        <li><a href="{{route('attendance.index')}}">@lang('lang.attendance')</a></li>
                        @endif
                        @if(auth()->user()->can('employees_module.leaves.view'))
                        <li><a href="{{route('leaves.index')}}">@lang('lang.view_list_of_employees_in_leave')</a></li>
                        @endif
                        @if(auth()->user()->can('employees_module.forfeit_leaves.view'))
                        <li><a href="{{route('forfeit-leaves.index')}}">@lang('lang.view_list_of_employees_in_forfeit_leave')</a></li>
                        @endif
                    </ul>
                </li> 
                @endif 
                @if(auth()->user()->can('suppliers_module.supplier.view'))                      
                <li>
                    <a href="{{route('suppliers.index')}}">
                        <i class="ri-hospital-fill"></i><span>@lang('lang.suppliers')</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('customers_module.customer.view'))
                <li>
                    <a href="{{route('customers.index')}}">
                        <i class="ri-hospital-fill"></i><span>@lang('lang.customers')</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="javaScript:void();">
                        <i class="ri-pages-line"></i>@lang('lang.extras')<i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="vertical-submenu">
                        @if(auth()->user()->can('settings_module.nationalities.view'))
                        <li><a href="{{route('nationality.index')}}">@lang('lang.nationalities')</a></li>
                        @endif
                        @if(auth()->user()->can('settings_module.types.view'))
                        <li><a href="{{route('types.index')}}">@lang('lang.types')</a></li>
                        @endif
                        @if(auth()->user()->can('settings_module.colors.view'))
                        <li><a href="{{route('colors.index')}}">@lang('lang.colors')</a></li>
                        @endif
                        @if(auth()->user()->can('settings_module.fills.view'))
                        <li><a href="{{route('fills.index')}}">@lang('lang.fills')</a></li>
                        @endif
                        @if(auth()->user()->can('settings_module.cars.view'))
                        <li><a href="{{route('cars.index')}}">@lang('lang.cars')</a></li>
                        @endif
                        <li><a href="{{route('opening.index')}}">@lang('lang.opening')</a></li>
                        <li><a href="{{route('screening.index')}}">@lang('lang.screening')</a></li>
                        <li><a href="{{route('branches.index')}}">@lang('lang.branches')</a></li>
                        <li><a href="{{route('stores.index')}}">@lang('lang.stores')</a></li>
                        <li><a href="{{route('lab.index')}}">@lang('lang.labs')</a></li>
                        <li><a href="{{route('calibers.index')}}">@lang('lang.calibers')</a></li>
                    </ul>
                </li> '
                @if(auth()->user()->can('settings_module.general_settings.view'))                      
                <li>
                    <a href="{{route('settings.index')}}">
                        <i class="ri-settings-line"></i><span>{{__('lang.settings')}}</span><span class="new-icon"></span>
                    </a>
                </li> 
                @endif                                          
            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>