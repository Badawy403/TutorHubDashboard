<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light pt-3">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item d-none">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item p-2 dropdown">
            <a type="button" class="dropdown-toggle text-dark" data-bs-target="WarD" data-toggle="dropdown" data-display="static" aria-haspopup="true"
               aria-expanded="false">

                <i style="font-size: 22px" class="fa-solid fa-users-viewfinder @if(!empty($data['totalLowProfileUsers']) &&  $data['totalLowProfileUsers'] > 0) text-warning @endif"></i>
                <span class="notifications-counter">{{ !empty($data['totalLowProfileUsers']) &&  $data['totalLowProfileUsers'] > 0 ? $data['totalLowProfileUsers'] : '--'}}</span>

            </a>
            <div id="WarD" class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-left">
                <a href="{{ route('super_admin.viewNotifications' , 'low_profile_teachers') }}"  class="dropdown-item">
                    <i class="dropdown-menu__icon fa fa-user-circle mr-1"></i>
                    <span class="dropdown-menu__caption">Low Rating Tutors</span>
                    <span class="notifications-counter">{{ !empty($data['totalLowProfileTeachers']) &&  $data['totalLowProfileTeachers'] > 0 ? ($data['totalLowProfileTeachers']) : '--'}}</span>
                </a>
                <a href="{{ route('super_admin.viewNotifications' , 'low_profile_academies') }}" class="dropdown-item">
                    <i class="dropdown-menu__icon fa fa-user-circle mr-1"></i>
                    <span class="dropdown-menu__caption">Low Rating Academies</span>
                    <span class="notifications-counter">{{ !empty($data['totalLowProfileAcademies']) &&  $data['totalLowProfileAcademies'] > 0 ? ($data['totalLowProfileAcademies']) : '--'}}</span>
                </a>
                <a href="{{ route('super_admin.viewNotifications' , 'completed_teacher_profiles') }}"  class="dropdown-item">
                    <i class="dropdown-menu__icon fa fa-user-circle mr-1"></i>
                    <span class="dropdown-menu__caption">Completed Tutor Profiles</span>
                    <span class="notifications-counter">{{ !empty($data['totalCompleteTeacherProfiles']) &&  $data['totalCompleteTeacherProfiles'] > 0 ? ($data['totalCompleteTeacherProfiles']) : '--'}}</span>
                </a>
                <a href="{{ route('super_admin.viewNotifications' , 'completed_academy_profiles') }}"  class="dropdown-item">
                    <i class="dropdown-menu__icon fa fa-user-circle mr-1"></i>
                    <span class="dropdown-menu__caption">Completed Academy Profiles</span>
                    <span class="notifications-counter">{{ !empty($data['totalCompleteAcademyProfiles']) &&  $data['totalCompleteAcademyProfiles'] > 0 ? ($data['totalCompleteAcademyProfiles']) : '--'}}</span>
                </a>
            </div>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto flex-row-reverse">
        <!-- Navbar Search -->
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> --}}

        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li> --}}
        <!-- Notifications Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> --}}

        {{--         <li> --}}
        {{--            <a class="btn btn-primary" --}}
        {{--                onclick="event.preventDefault(); --}}
        {{--                                          document.getElementById('logout-form').submit();"> --}}
        {{--                {{ __('Logout') }} --}}
        {{--            </a> --}}
        {{--            <form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" class="d-none"> --}}
        {{--                @csrf --}}
        {{--            </form> --}}
        {{--        </li> --}}


        <li class="nav-item px-3 dropdown">
            <a type="button" class="dropdown-toggle text-dark" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                aria-expanded="false">

                <span class="navbar-user">
                    <span class="navbar-user__thumb">
                        @if (Auth::user()->profile_image_path)
                            <img class="brand-image img-circle border-2 border"
                                src="{{ url(Auth::user()->profile_image_path) }}" alt="avatar" height="40"
                                width="40">
                        @else
                            <img class="brand-image img-circle shadow-sm"
                                src="https://ui-avatars.com/api/?name={{ str_replace(' ', '+', Auth::user()->name) }}&amp;color=7F9CF5&amp;background=EBF4FF"
                                alt="avatar" height="40" width="40">
                        @endif
                    </span>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
                <a href="{{ route('super_admin.profile.index') }}" class="dropdown-item">
                    <i class="dropdown-menu__icon fa fa-user-circle mr-1"></i>
                    <span class="dropdown-menu__caption">Profile</span>
                </a>

                <a href="{{ route('super_admin.logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    class="dropdown-item">
                    <i class="dropdown-menu__icon fa fa-sign-in-alt mr-1"></i>
                    <span class="dropdown-menu__caption">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('super_admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>
<!-- /.navbar -->
