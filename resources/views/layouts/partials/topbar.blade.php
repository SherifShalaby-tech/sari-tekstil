 <!-- Start Topbar Mobile -->
 <div class="topbar-mobile">
     <div class="row align-items-center">
         <div class="col-md-12">
             <div class="mobile-logobar">
                 <a href="index.html" class="mobile-logo"><img src="assets/images/logo.svg" class="img-fluid"
                         alt="logo"></a>
             </div>
             <div class="mobile-togglebar">
                 <ul class="list-inline mb-0">
                     <li class="list-inline-item">
                         <div class="topbar-toggle-icon">
                             <a class="topbar-toggle-hamburger" href="javascript:void();">
                                 <i class="ri-more-fill menu-hamburger-horizontal"></i>
                                 <i class="ri-more-2-fill menu-hamburger-vertical"></i>
                             </a>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="menubar">
                             <a class="menu-hamburger" href="javascript:void();">
                                 <i class="ri-menu-2-line menu-hamburger-collapse"></i>
                                 <i class="ri-close-line menu-hamburger-close"></i>
                             </a>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <div class="topbar">
     <!-- Start row -->
     <div class="row align-items-center">
         <!-- Start col -->
         <div class="col-md-12 align-self-center">
             <div class="togglebar">
                 <ul class="list-inline mb-0">
                     <li class="list-inline-item">
                         <div class="menubar">
                             <a class="menu-hamburger" href="javascript:void();">
                                 <i class="ri-menu-2-line menu-hamburger-collapse"></i>
                                 <i class="ri-close-line menu-hamburger-close"></i>

                             </a>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="searchbar">
                             <form>
                                 <div class="input-group">
                                     <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                         aria-describedby="button-addon2">
                                     <div class="input-group-append">
                                         <button class="btn" type="submit" id="button-addon2"><i
                                                 class="ri-search-2-line"></i></button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </li>
                 </ul>
             </div>
             <div class="infobar">
                 <ul class="list-inline mb-0">
                     <li class="list-inline-item">
                         <div class="settingbar">
                             <a href="https://api.whatsapp.com/send?phone={{ !empty($settings['watsapp_number']) ? $settings['watsapp_number'] : '' }}"
                                 id="infobar-watsapp-open" class="infobar-icon"><i class="dripicons-phone"></i></a>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="settingbar">
                             <a href="javascript:void(0)" id="infobar-settings-open" class="infobar-icon"><i
                                     class="ri-settings-line"></i></a>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="notifybar">
                             <div class="dropdown">
                                 <a class="dropdown-toggle infobar-icon" href="#" role="button"
                                     id="notoficationlink" data-toggle="dropdown" aria-haspopup="true"
                                     aria-expanded="false"><i class="ri-notification-line"></i>
                                     <span class="live-icon"></span></a>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notoficationlink">
                                     <div class="notification-dropdown-title">
                                         <h5>Notifications<a href="#">Clear all</a></h5>
                                     </div>
                                     <ul class="list-unstyled">
                                         <li class="media dropdown-item">
                                             <span class="action-icon badge badge-primary"><i
                                                     class="ri-bank-card-2-line"></i></span>
                                             <div class="media-body">
                                                 <h5 class="action-title">Payment Success !!!</h5>
                                                 <p><span class="timing">Today, 09:05 AM</span></p>
                                             </div>
                                         </li>
                                         <li class="media dropdown-item">
                                             <span class="action-icon badge badge-success"><i
                                                     class="ri-file-user-line"></i></span>
                                             <div class="media-body">
                                                 <h5 class="action-title">Riva applied for job</h5>
                                                 <p><span class="timing">Yesterday, 02:30 PM</span></p>
                                             </div>
                                         </li>
                                         <li class="media dropdown-item">
                                             <span class="action-icon badge badge-secondary"><i
                                                     class="ri-pencil-line"></i></span>
                                             <div class="media-body">
                                                 <h5 class="action-title">Maria requested to leave</h5>
                                                 <p><span class="timing">5 June 2020, 12:10 PM</span></p>
                                             </div>
                                         </li>
                                         <li class="media dropdown-item">
                                             <span class="action-icon badge badge-warning"><i
                                                     class="ri-shopping-cart-line"></i></span>
                                             <div class="media-body">
                                                 <h5 class="action-title">New order placed</h5>
                                                 <p><span class="timing">1 Jun 2020, 04:40 PM</span></p>
                                             </div>
                                         </li>
                                     </ul>
                                     <div class="notification-dropdown-footer">
                                         <h5><a href="#">See all</a></h5>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="languagebar">
                             <div class="dropdown">
                                 @php
                                     $flags = (object) [
                                         'en' => 'us',
                                         'ar' => 'eg',
                                         'tr' => 'tr',
                                     ];
                                     $local_code = LaravelLocalization::getCurrentLocale();
                                 @endphp
                                 <a class="dropdown-toggle" href="#" role="button" id="languagelink"
                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                         class="flag flag-icon-{{ $flags->$local_code }} flag-icon-squared"></i></a>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languagelink">
                                     @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                         <a class="dropdown-item" hreflang="{{ $localeCode }}"
                                             href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                             <i
                                                 class="flag flag-icon-{{ $flags->$localeCode }} flag-icon-squared"></i>{{ $properties['native'] }}
                                         </a>
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="profilebar">
                             <div class="dropdown">
                                 <a class="dropdown-toggle" href="#" role="button" id="profilelink"
                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                         src="{{ asset('images/users/profile.svg') }}" class="img-fluid"
                                         alt="profile"><span class="live-icon">{{ Auth::user()->name }}</span></a>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                     <a class="dropdown-item" href="#"><i class="ri-user-6-line"></i>My
                                         Profile</a>
                                     <a class="dropdown-item" href="#"><i class="ri-mail-line"></i>Email</a>
                                     <a class="dropdown-item" href="#"><i
                                             class="ri-settings-3-line"></i>Settings</a>
                                     <a href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                         class="dropdown-item text-danger"><i class="ri-shut-down-line"></i>Logout</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                         style="display: none;">
                                         @csrf
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </li>
                     <li class="list-inline-item">
                         <div class="profilebar">
                             <div class="dropdown">
                                 <a class="dropdown-toggle" href="#" role="button" id="profilelink"
                                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     <div style="width: 20px;">
                                         <svg xmlns="http://www.w3.org/2000/svg" style="width: 100%"
                                             viewBox="0 0 511.998 511.998"
                                             style="enable-background:new 0 0 511.998 511.998" xml:space="preserve">
                                             <path style="fill:#9bddd1"
                                                 d="M494.889 191.989c5.448 20.411 8.363 41.873 8.363 64.01s-2.914 43.601-8.363 64.01l-.551-.147-113.035-30.291a129.222 129.222 0 0 0 4.408-33.572c0-11.607-1.53-22.859-4.408-33.572l113.035-30.291.551-.147z" />
                                             <path style="fill:#abefe6"
                                                 d="m494.889 191.989-.551.147-113.035 30.291c-5.951-22.333-17.716-42.278-33.585-58.146l82.757-82.757.355-.355c30.242 30.232 52.684 68.261 64.059 110.82z" />
                                             <path style="fill:#82c1b2"
                                                 d="m494.339 319.864.551.147c-11.376 42.559-33.818 80.589-64.06 110.819l-.355-.355-82.757-82.757c15.868-15.868 27.634-35.813 33.585-58.146l113.036 30.292z" />
                                             <path style="fill:#b26300"
                                                 d="m430.83 81.17-.355.355-82.757 82.757c-15.868-15.868-35.813-27.634-58.146-33.585l30.291-113.035.147-.551c42.547 11.375 80.578 33.817 110.82 64.059z" />
                                             <path style="fill:#f23488"
                                                 d="m430.474 430.475.355.355c-30.242 30.242-68.271 52.685-110.819 64.059l-.147-.551-30.291-113.035c22.333-5.951 42.278-17.716 58.146-33.585l82.756 82.757z" />
                                             <path style="fill:#387762"
                                                 d="m255.999 141.153 99.469 172.271H156.531l99.468-172.271z" />
                                             <path style="fill:#db2a78"
                                                 d="m319.864 494.339.147.551c-20.411 5.448-41.873 8.363-64.01 8.363s-43.588-2.914-64.01-8.363l.147-.551 30.291-113.023c10.702 2.865 21.965 4.395 33.572 4.395s22.859-1.53 33.572-4.408l30.291 113.036z" />
                                             <path style="fill:#d88a20"
                                                 d="m320.011 17.111-.147.551-30.291 113.035a129.265 129.265 0 0 0-33.572-4.408c-11.607 0-22.872 1.53-33.572 4.395L192.137 17.66l-.147-.551c20.422-5.448 41.873-8.363 64.01-8.363s43.6 2.916 64.011 8.365z" />
                                             <path style="fill:#ea9b22"
                                                 d="m192.136 17.661 30.291 113.023c-22.333 5.963-42.278 17.729-58.146 33.597L81.525 81.525l-.355-.355c30.231-30.242 68.271-52.685 110.819-64.059l.147.55z" />
                                             <path style="fill:#bf1d64"
                                                 d="m222.427 381.315-30.291 113.023-.147.551C149.441 483.514 111.4 461.072 81.17 430.83l.355-.355 82.757-82.757c15.867 15.868 35.812 27.635 58.145 33.597z" />
                                             <path style="fill:#23ce9e"
                                                 d="M130.696 289.573c5.951 22.333 17.716 42.278 33.585 58.146l-82.757 82.757-.355.355c-30.242-30.23-52.685-68.26-64.059-110.819l.551-.147 113.035-30.292z" />
                                             <path style="fill:#0f9966"
                                                 d="m81.525 81.525 82.757 82.757c-15.868 15.868-27.634 35.813-33.585 58.146L17.661 192.136l-.551-.147C28.486 149.43 50.928 111.4 81.17 81.17l.355.355z" />
                                             <path style="fill:#19b783"
                                                 d="m17.662 192.136 113.035 30.291c-2.877 10.713-4.408 21.965-4.408 33.572s1.53 22.859 4.408 33.572L17.662 319.863l-.551.147c-5.448-20.411-8.363-41.873-8.363-64.01s2.914-43.601 8.363-64.01l.551.146z" />
                                             <path
                                                 d="M503.341 189.731c-11.559-43.249-34.494-82.927-66.326-114.746-31.833-31.833-71.513-54.768-114.748-66.326C300.745 2.914 278.45 0 255.999 0c-22.436 0-44.731 2.914-66.27 8.659-43.251 11.562-82.93 34.497-114.745 66.324-31.833 31.821-54.768 71.501-66.326 114.75C2.914 211.254 0 233.549 0 255.999s2.914 44.746 8.659 66.27c11.558 43.247 34.493 82.927 66.323 114.745a258.235 258.235 0 0 0 24.726 21.753c3.821 2.952 9.316 2.246 12.27-1.579a8.747 8.747 0 0 0-1.579-12.27 241.203 241.203 0 0 1-16.737-14.211l70.816-70.816c13.819 12.177 29.926 21.487 47.304 27.341l-25.938 96.778a237.318 237.318 0 0 1-49.491-21.64c-4.182-2.427-9.533-1.009-11.959 3.169a8.748 8.748 0 0 0 3.168 11.959 254.784 254.784 0 0 0 62.169 25.843c21.535 5.744 43.829 8.658 66.266 8.658 22.451 0 44.745-2.914 66.268-8.659 43.235-11.558 82.914-34.492 114.746-66.324 31.832-31.819 54.767-71.499 66.326-114.75 5.746-21.521 8.659-43.817 8.659-66.267s-2.91-44.745-8.655-66.268zm-8.837 66.268c0 17.985-2.018 35.855-5.979 53.249l-96.779-25.935a138.665 138.665 0 0 0 2.712-27.315c0-9.212-.914-18.367-2.712-27.315l96.779-25.936a239.958 239.958 0 0 1 5.979 53.252zm-130.69 54.85a8.642 8.642 0 0 0-.769-1.8l-99.469-172.271a8.696 8.696 0 0 0-1.168-1.558c8.442.443 16.795 1.75 24.913 3.93 20.419 5.441 39.165 16.27 54.213 31.318s25.878 33.794 31.322 54.23A120.69 120.69 0 0 1 376.964 256a120.715 120.715 0 0 1-4.113 31.319 119.856 119.856 0 0 1-9.037 23.53zM193.493 249.41a8.746 8.746 0 0 0-11.95 3.202l-32.587 56.438a8.78 8.78 0 0 0-.769 1.8 119.793 119.793 0 0 1-9.042-23.546A120.703 120.703 0 0 1 135.038 256c0-10.623 1.382-21.155 4.112-31.32 5.44-20.419 16.27-39.165 31.319-54.213 15.043-15.043 33.792-25.878 54.222-31.333 8.109-2.171 16.46-3.472 24.904-3.914a8.821 8.821 0 0 0-1.169 1.558l-50.677 87.769a8.748 8.748 0 0 0 3.202 11.95c4.182 2.416 9.533.982 11.95-3.202l43.102-74.649 84.316 146.029H171.683l25.01-43.316a8.746 8.746 0 0 0-3.2-11.949zm18.292-124.644c-17.38 5.856-33.486 15.165-47.304 27.343L93.664 81.292c26.367-24.514 57.943-42.77 92.185-53.302l25.936 96.776zm148.106 39.715 33.657-33.659a8.748 8.748 0 1 0-12.372-12.371l-33.656 33.657c-13.825-12.182-29.933-21.49-47.304-27.333l25.936-96.786c34.23 10.529 65.804 28.784 92.183 53.303l-14.996 14.996a8.748 8.748 0 0 0 6.187 14.934 8.722 8.722 0 0 0 6.187-2.563l14.997-14.997c24.516 26.37 42.773 57.944 53.302 92.183l-96.786 25.937c-5.849-17.375-15.156-33.479-27.335-47.301zM309.25 23.474l-25.936 96.785c-17.933-3.587-36.693-3.585-54.626-.008l-25.937-96.774a239.97 239.97 0 0 1 53.248-5.98 239.914 239.914 0 0 1 53.251 5.977zM81.292 93.664l70.817 70.817c-12.183 13.824-21.49 29.932-27.334 47.303l-42.38-11.357a8.748 8.748 0 0 0-4.529 16.899l42.388 11.359a138.667 138.667 0 0 0-2.712 27.313c0 9.211.913 18.366 2.712 27.315l-96.778 25.935c-3.962-17.394-5.98-35.265-5.98-53.249s2.018-35.855 5.979-53.249l30.06 8.056a8.773 8.773 0 0 0 2.27.301 8.748 8.748 0 0 0 2.259-17.2l-30.074-8.06c10.527-34.238 28.783-65.811 53.302-92.183zM27.99 326.153l96.786-25.937c5.847 17.377 15.154 33.481 27.333 47.303L81.29 418.338c-24.516-26.371-42.772-57.945-53.3-92.185zm126.608-4.214a8.76 8.76 0 0 0 1.933.232h198.938c.66 0 1.304-.09 1.933-.232a121.375 121.375 0 0 1-15.868 19.594c-15.048 15.048-33.795 25.876-54.23 31.322-20.305 5.453-42.295 5.451-62.62.009-20.426-5.454-39.173-16.287-54.216-31.33a121.395 121.395 0 0 1-15.87-19.595zm145.617 65.285c17.377-5.847 33.482-15.154 47.304-27.333l70.816 70.816c-26.379 24.518-57.954 42.774-92.185 53.303l-25.935-96.786zm-97.465 101.3 25.937-96.771a139.01 139.01 0 0 0 54.628-.007l25.935 96.779a239.904 239.904 0 0 1-53.249 5.978 239.904 239.904 0 0 1-53.251-5.979zm227.96-70.186-70.817-70.817c12.179-13.822 21.485-29.927 27.332-47.303l96.786 25.937c-10.53 34.239-28.786 65.813-53.301 92.183z" />
                                         </svg>
                                     </div>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right" style="width: 35px !important"
                                     aria-labelledby="profilelink">
                                     {{-- <a class="dropdown-item" href="#"> <label for="light">Light</label>
                                         <input type="radio" name="theme" id="light">
                                     </a>
                                     <a class="dropdown-item" href="#">
                                         <label for="pink">Pink theme</label>
                                         <input type="radio" id="pink" name="theme">
                                     </a>
                                     <a class="dropdown-item" href="#">
                                         <label for="blue">Blue theme</label>
                                         <input type="radio" id="blue" name="theme" checked>
                                     </a>
                                     <a class="dropdown-item" href="#">
                                         <label for="green">Green theme</label>
                                         <input type="radio" id="green" name="theme">
                                     </a>
                                     <a class="dropdown-item" href="#">
                                         <label for="dark">Dark theme</label>
                                         <input type="radio" id="dark" name="theme">
                                     </a> --}}
                                     <a class="dropdown-item" style="width: 35px !important" href="#">
                                         <label class="w-100 h-100 position-relative blue" for="blue">
                                         </label>
                                         <input type="radio" class="d-none" id="blue" name="theme">
                                     </a>
                                     <a class="dropdown-item" style="width: 35px !important" href="#">
                                         <label class="w-100 h-100 green position-relative" for="green">
                                         </label>
                                         <input type="radio" class="d-none w-100 h-100" id="green"
                                             name="theme">
                                     </a>
                                     <a class="dropdown-item" style="width: 35px !important" href="#">
                                         <label class="w-100 h-100 dust position-relative" for="dust"></label>
                                         <input type="radio" class="d-none" id="dust" name="theme">
                                     </a>
                                     <a class="dropdown-item" style="width: 35px !important" href="#">
                                         <label class="w-100 h-100 pink position-relative" for="pink"></label>
                                         <input type="radio" class="d-none" id="pink" name="theme">
                                     </a>
                                     <a class="dropdown-item" style="width: 35px !important" href="#">
                                         <label class="w-100 h-100 dark position-relative" for="dark"></label>
                                         <input type="radio" class="d-none" id="dark" name="theme">
                                     </a>
                                 </div>

                             </div>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
         <!-- End col -->
     </div>
     <!-- End row -->
 </div>
