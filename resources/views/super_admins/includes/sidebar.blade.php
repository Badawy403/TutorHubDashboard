<style>
    .icon-size {
        font-size: 10px;
        padding-right: 3px;
    }

    .main-sidebar .brand-image {
        height: 24px;
    }

    .nav-link-active {
        background-color: rgba(255, 255, 255, .1);
        color: #fff;
    }

    .border-leftside {
        width: 6px;
        height: 30px;
        background-color: #0B0C2A;
        border-radius: 8px;
        position: absolute;
        top: 7px;
        left: -5px;
    }

    .border-leftside-active {
        width: 5px;
        height: 32px;
        background-color: white;
        border-radius: 8px;
        position: absolute;
        top: 7px;
        left: -5px;
    }
</style>
@php
    $site_logo = App\Models\GeneralSetting::where('name', 'logo')->first();
    $dark_site_logo = App\Models\GeneralSetting::where('name', 'dark_logo')->first();

    $user = auth()->user();
    $general_settings = generalSettings();
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="{{ route('super_admin.dashboard') }}" class="d-flex flex-column align-items-center pt-3 bg-white">
        <img src="{{ $site_logo && $site_logo->value ? asset($site_logo->value) : asset('images/logo.png') }}"
            alt="zLogo" class="brand-image" style="height: 50px;">
        <!-- <span class="brand-text font-weight-light h5 mb-0 text-capitalize">
            {{ Auth::user()->name }}
        </span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
       <div class="input-group" data-widget="sidebar-search">
         <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
           <button class="btn btn-sidebar">
             <i class="fas fa-search fa-fw"></i>
           </button>
         </div>
       </div>
     </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column position-relative" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('super_admin.dashboard') }}"
                        class="nav-link @if (Route::is('super_admin.dashboard')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.dashboard')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-home icon-size"></i>
                        <span class="text">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('super_admin.students.index') }}"
                        class="nav-link @if (Route::is('super_admin.students.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.students.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-graduation-cap icon-size"></i>
                        <span class="text">
                            Students
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.teachers.*') ||
                            Route::is('super_admin.teacher_categories.*') ||
                            Route::is('super_admin.teacher_main_categories.*') ||
                            Route::is('super_admin.teacher_posts.*') ||
                            Route::is('super_admin.teacher_events.*') ||
                            Route::is('super_admin.teacher_educations.*') ||
                            Route::is('super_admin.teacher_certifications.*') ||
                            Route::is('super_admin.teacher_experiences.*') ||
                            Route::is('super_admin.teacher_broadcasts.*') ||
                            Route::is('super_admin.teacher_podcasts.*') ||
                            Route::is('super_admin.teacher_archives.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse100" role="button"
                        aria-expanded="@if (Route::is('super_admin.teachers.*') ||
                                Route::is('super_admin.teacher_categories.*') ||
                                Route::is('super_admin.teacher_main_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse100">
                        <span
                            class="border-leftside @if (Route::is('super_admin.teachers.*') ||
                                    Route::is('super_admin.teacher_categories.*') ||
                                    Route::is('super_admin.teacher_main_categories.*') ||
                                    Route::is('super_admin.teacher_posts.*') ||
                                    Route::is('super_admin.teacher_events.*') ||
                                    Route::is('super_admin.teacher_educations.*') ||
                                    Route::is('super_admin.teacher_certifications.*') ||
                                    Route::is('super_admin.teacher_experiences.*') ||
                                    Route::is('super_admin.teacher_broadcasts.*') ||
                                    Route::is('super_admin.teacher_podcasts.*') ||
                                    Route::is('super_admin.teacher_archives.*')) border-leftside-active @endif"></span>

                        <span><i class="fa-solid fa-chalkboard-user icon-size"></i> <span
                                class="text">Tutors</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.teachers.*') ||
                            Route::is('super_admin.teacher_categories.*') ||
                            Route::is('super_admin.teacher_main_categories.*') ||
                            Route::is('super_admin.teacher_posts.*') ||
                            Route::is('super_admin.teacher_events.*') ||
                            Route::is('super_admin.teacher_educations.*') ||
                            Route::is('super_admin.teacher_certifications.*') ||
                            Route::is('super_admin.teacher_experiences.*') ||
                            Route::is('super_admin.teacher_broadcasts.*') ||
                            Route::is('super_admin.teacher_podcasts.*') ||
                            Route::is('super_admin.teacher_archives.*')) collapsed show @else collapse @endif"
                        id="collapse100">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.teacher_main_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.teacher_main_categories.*')) nav-link-sub-active @endif">
                                    Tutor Main Categories</a></li>
                            <li><a href="{{ route('super_admin.teacher_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.teacher_categories.*')) nav-link-sub-active @endif">
                                    Tutor Categories</a></li>
                            <li>
                                <a href="{{ route('super_admin.teachers.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.teachers.*') ||
                                            Route::is('super_admin.teacher_posts.*') ||
                                            Route::is('super_admin.teacher_events.*') ||
                                            Route::is('super_admin.teacher_educations.*') ||
                                            Route::is('super_admin.teacher_certifications.*') ||
                                            Route::is('super_admin.teacher_experiences.*') ||
                                            Route::is('super_admin.teacher_broadcasts.*') ||
                                            Route::is('super_admin.teacher_podcasts.*') ||
                                            Route::is('super_admin.teacher_archives.*')) nav-link-sub-active @endif">Tutors</a>

                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.academies.*') ||
                            Route::is('super_admin.academy_categories.*') ||
                            Route::is('super_admin.academy_main_categories.*') ||
                            Route::is('super_admin.academy_posts.*') ||
                            Route::is('super_admin.academy_events.*') ||
                            Route::is('super_admin.academy_educations.*') ||
                            Route::is('super_admin.academy_certifications.*') ||
                            Route::is('super_admin.academy_experiences.*') ||
                            Route::is('super_admin.academy_broadcasts.*') ||
                            Route::is('super_admin.academy_podcasts.*') ||
                            Route::is('super_admin.academy_archives.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse101" role="button"
                        aria-expanded="@if (Route::is('super_admin.academies.*') ||
                                Route::is('super_admin.academy_categories.*') ||
                                Route::is('super_admin.academy_main_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse101">
                        <span
                            class="border-leftside @if (Route::is('super_admin.academies.*') ||
                                    Route::is('super_admin.academy_categories.*') ||
                                    Route::is('super_admin.academy_main_categories.*') ||
                                    Route::is('super_admin.academy_posts.*') ||
                                    Route::is('super_admin.academy_events.*') ||
                                    Route::is('super_admin.academy_educations.*') ||
                                    Route::is('super_admin.academy_certifications.*') ||
                                    Route::is('super_admin.academy_experiences.*') ||
                                    Route::is('super_admin.academy_broadcasts.*') ||
                                    Route::is('super_admin.academy_podcasts.*') ||
                                    Route::is('super_admin.academy_archives.*')) border-leftside-active @endif"></span>

                        <span><i class="fa-solid fa-building-columns icon-size"></i> <span
                                class="text">Academies</span></span> <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.academies.*') ||
                            Route::is('super_admin.academy_categories.*') ||
                            Route::is('super_admin.academy_main_categories.*') ||
                            Route::is('super_admin.academy_posts.*') ||
                            Route::is('super_admin.academy_events.*') ||
                            Route::is('super_admin.academy_educations.*') ||
                            Route::is('super_admin.academy_certifications.*') ||
                            Route::is('super_admin.academy_experiences.*') ||
                            Route::is('super_admin.academy_broadcasts.*') ||
                            Route::is('super_admin.academy_podcasts.*') ||
                            Route::is('super_admin.academy_archives.*')) collapsed show @else collapse @endif"
                        id="collapse101">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.academy_main_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.academy_main_categories.*')) nav-link-sub-active @endif">
                                    Academy Main Categories</a></li>
                            <li><a href="{{ route('super_admin.academy_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.academy_categories.*')) nav-link-sub-active @endif">
                                    Academy Categories</a></li>
                            <li><a href="{{ route('super_admin.academies.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.academies.*') ||
                                            Route::is('super_admin.academy_posts.*') ||
                                            Route::is('super_admin.academy_events.*') ||
                                            Route::is('super_admin.academy_educations.*') ||
                                            Route::is('super_admin.academy_certifications.*') ||
                                            Route::is('super_admin.academy_experiences.*') ||
                                            Route::is('super_admin.academy_broadcasts.*') ||
                                            Route::is('super_admin.academy_podcasts.*') ||
                                            Route::is('super_admin.academy_archives.*')) nav-link-sub-active @endif">Academies</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.events.*') || Route::is('super_admin.event_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse106" role="button"
                        aria-expanded="@if (Route::is('super_admin.archives.*') || Route::is('super_admin.archive_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse106">
                        <span
                            class="border-leftside @if (Route::is('super_admin.events.*') || Route::is('super_admin.event_categories.*')) border-leftside-active @endif"></span>

                        <span><i class="fa-solid fa-calendar icon-size"></i><span class="text">Events</span></span> <i
                            class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.events.*') || Route::is('super_admin.event_categories.*')) collapsed show @else collapse @endif"
                        id="collapse106">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.event_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.event_categories.*')) nav-link-sub-active @endif">Event
                                    Categories</a></li>
                            <li><a href="{{ route('super_admin.events.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.events.*')) nav-link-sub-active @endif">Events</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.booked_appointments.index') }}"
                        class="nav-link @if (Route::is('super_admin.booked_appointments.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.booked_appointments.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-file-alt icon-size"></i>
                        <span class="text">
                            Booked Appointments
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.podcasts.*') || Route::is('super_admin.podcast_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse108" role="button"
                        aria-expanded="@if (Route::is('super_admin.podcasts.*') || Route::is('super_admin.podcast_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse108">
                        <span
                            class="border-leftside @if (Route::is('super_admin.podcasts.*') || Route::is('super_admin.podcast_categories.*')) border-leftside-active @endif"></span>
                        <span><i class="fas fa-microphone icon-size"></i> <span class="text">Podcasts</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.podcasts.*') || Route::is('super_admin.podcast_categories.*')) collapsed show @else collapse @endif"
                        id="collapse108">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.podcast_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.podcast_categories.*')) nav-link-sub-active @endif">
                                    Podcast Categories</a></li>
                            <li><a href="{{ route('super_admin.podcasts.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.podcasts.*')) nav-link-sub-active @endif">Podcasts</a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.services.*') || Route::is('super_admin.service_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse109" role="button"
                        aria-expanded="@if (Route::is('super_admin.services.*') || Route::is('super_admin.service_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse109">

                        <span><i class="fas fa-microphone icon-size"></i> <span
                                class="text">Services</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.services.*') || Route::is('super_admin.service_categories.*')) collapsed show @else collapse @endif"
                        id="collapse109">
                        <ul class="text-white">

                                <li><a href="{{ route('super_admin.service_categories.index') }}"
                                        class="nav-link-sub @if (Route::is('super_admin.service_categories.*')) nav-link-sub-active @endif">
                                        Service Categories</a></li>



                                <li><a href="{{ route('super_admin.services.index') }}"
                                        class="nav-link-sub @if (Route::is('super_admin.services.*')) nav-link-sub-active @endif">Services</a>
                                </li>


                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.broadcasts.*') || Route::is('super_admin.broadcast_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse111" role="button"
                        aria-expanded="@if (Route::is('super_admin.broadcasts.*') || Route::is('super_admin.broadcast_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse111">
                        <span
                            class="border-leftside @if (Route::is('super_admin.broadcasts.*') || Route::is('super_admin.broadcast_categories.*')) border-leftside-active @endif"></span>
                        <span><i class="fa fa-camera icon-size"></i> <span class="text">Media</span></span> <i
                            class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.broadcasts.*') || Route::is('super_admin.broadcast_categories.*')) collapsed show @else collapse @endif"
                        id="collapse111">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.broadcast_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.broadcast_categories.*')) nav-link-sub-active @endif">
                                    Media Categories</a></li>
                            <li><a href="{{ route('super_admin.broadcasts.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.broadcasts.*')) nav-link-sub-active @endif">Media</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if ($general_settings['commission_type'] == 'subscription_base')
                    <li class="nav-item">
                        <a href="{{ route('super_admin.pricing_plans.index') }}"
                            class="nav-link @if (Route::is('super_admin.pricing_plans.*')) nav-link-active @endif">
                            <span
                                class="border-leftside @if (Route::is('super_admin.pricing_plans.*')) border-leftside-active @endif"></span>
                            <i class="fa-solid fa-money-bill icon-size"></i>
                            <span class="text">
                                Pricing Plans
                            </span>
                        </a>
                    </li>
                @endif


                @if ($general_settings['commission_type'] == 'commission_base')
                    <li class="nav-item">
                        <a href="{{ route('super_admin.commission.index') }}"
                            class="nav-link @if (Route::is('super_admin.commission.*')) nav-link-active @endif">
                            <span
                                class="border-leftside @if (Route::is('super_admin.commission.*')) border-leftside-active @endif"></span>
                            <i class="fa-solid fa-layer-group icon-size"></i>
                            <span class="text">
                                Commission Configuration
                            </span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('super_admin.bank_accounts.index') }}"
                        class="nav-link @if (Route::is('super_admin.bank_accounts.*')) nav-link-active @endif">
                        <i class="fa-solid fa fa-bank icon-size"></i>
                        <span class="text">
                            Bank Accounts
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.bank_transactions.index') }}"
                        class="nav-link @if (Route::is('super_admin.bank_transactions.*')) nav-link-active @endif">

                        <i class="fa-solid fa fa-money-bill-alt icon-size"></i>
                        <span class="text">
                            Bank Transactions
                        </span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.archive_categories.*')) nav-link-active @endif"  data-toggle="collapse" href="#collapse104" role="button" aria-expanded="@if (Route::is('super_admin.blog_categories.*') || Route::is('super_admin.archive_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif" aria-controls="collapse104">
                    <span class="shape-1"></span>
                    <span class="shape-2"></span>
                    <span><i class="fa-solid fa-layer-group icon-size"></i> <span class="text">Misc. Categories</span></span> <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.archive_categories.*')) collapsed show @else collapse @endif" id="collapse104">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.blog_categories.index') }}" class="nav-link-sub @if (Route::is('super_admin.blog_categories.*')) nav-link-sub-active @endif">Blog Categories</a></li>
                            <li><a href="{{ route('super_admin.archive_categories.index') }}" class="nav-link-sub @if (Route::is('super_admin.archive_categories.*')) nav-link-sub-active @endif">Archive Categories</a></li>
                        </ul>
                    </div>
                </li> -->
                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.pricing_plans.index') }}"
                        class="nav-link @if (Route::is('super_admin.pricing_plans.*')) nav-link-active @endif">

                        <i class="fa-solid fa-money-bill icon-size"></i>
                        <span class="text">
                            Pricing Plans
                        </span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.faqs.*') || Route::is('super_admin.faq_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse102" role="button"
                        aria-expanded="@if (Route::is('super_admin.faqs.*') || Route::is('super_admin.faq_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse102">
                        <span
                            class="border-leftside @if (Route::is('super_admin.faqs.*') || Route::is('super_admin.faq_categories.*')) border-leftside-active @endif"></span>
                        <span><i class="fa-solid fa-question-circle icon-size"></i> <span
                                class="text">FAQS</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.faqs.*') || Route::is('super_admin.faq_categories.*')) collapsed show @else collapse @endif"
                        id="collapse102">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.faq_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.faq_categories.*')) nav-link-sub-active @endif">
                                    FAQ Categories</a></li>
                            <li><a href="{{ route('super_admin.faqs.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.faqs.*')) nav-link-sub-active @endif">FAQS</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.posts.*') || Route::is('super_admin.blog_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse103" role="button"
                        aria-expanded="@if (Route::is('super_admin.posts.*') || Route::is('super_admin.blog_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse103">
                        <span
                            class="border-leftside @if (Route::is('super_admin.posts.*') || Route::is('super_admin.blog_categories.*')) border-leftside-active @endif"></span>
                        <span><i class="fa-solid fa-rss icon-size"></i><span class="text">Blogs</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.posts.*') || Route::is('super_admin.blog_categories.*')) collapsed show @else collapse @endif"
                        id="collapse103">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.blog_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.blog_categories.*')) nav-link-sub-active @endif">Blog
                                    Categories</a></li>
                            <li><a href="{{ route('super_admin.posts.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.posts.*')) nav-link-sub-active @endif">Blogs</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.archives.*') || Route::is('super_admin.archive_categories.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse104" role="button"
                        aria-expanded="@if (Route::is('super_admin.archives.*') || Route::is('super_admin.archive_categories.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse104">
                        <span
                            class="border-leftside @if (Route::is('super_admin.archives.*') || Route::is('super_admin.archive_categories.*')) border-leftside-active @endif"></span>
                        <span><i class="fa-solid fa-layer-group icon-size"></i><span
                                class="text">Courses</span></span> <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.archives.*') || Route::is('super_admin.archive_categories.*')) collapsed show @else collapse @endif"
                        id="collapse104">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.archive_categories.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.archive_categories.*')) nav-link-sub-active @endif">Course
                                    Categories</a></li>
                            <li><a href="{{ route('super_admin.archives.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.archives.*')) nav-link-sub-active @endif">Courses</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.users.index') }}" class="nav-link @if (Route::is('super_admin.users.*')) nav-link-active @endif">
                    <span class="shape-1"></span>
                    <span class="shape-2"></span>
                    <i class="fa-solid fa-users icon-size"></i>
                    <span class="text">
                        Users
                    </span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('super_admin.testimonials.index') }}"
                        class="nav-link @if (Route::is('super_admin.testimonials.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.testimonials.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-quote-left icon-size"></i>
                        <span class="text">
                            Testimonials
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.tags.index') }}"
                        class="nav-link @if (Route::is('super_admin.tags.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.tags.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-tag icon-size"></i>
                        <span class="text">
                            Tags
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.contacts.index') }}"
                        class="nav-link @if (Route::is('super_admin.contacts.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.contacts.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-comment icon-size"></i>
                        <span class="text">
                            Contacts
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.gateways.index') }}"
                        class="nav-link @if (Route::is('super_admin.gateways.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.gateways.*')) border-leftside-active @endif"></span>
                        {{-- <i class="fa-solid fa-comment icon-size"></i> --}}
                        <i class="fa-solid fa-money-check-dollar icon-size"></i>
                        <span class="text">
                            Gateways
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.currencies.index') }}"
                        class="nav-link @if (Route::is('super_admin.currencies.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.currencies.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-dollar-sign icon-size"></i>
                        <span class="text">
                            Currencies
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.withdraw_requests.index') }}"
                        class="nav-link @if (Route::is('super_admin.withdraw_requests.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.withdraw_requests.*')) border-leftside-active @endif"></span>
                        {{-- <i class="fa-solid fa-comment icon-size"></i> --}}
                        <i class="fa-solid fa-money-bill-transfer icon-size"></i>
                        <span class="text">
                            Withdraw Requests
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('super_admin.company_pages.index') }}"
                        class="nav-link @if (Route::is('super_admin.company_pages.*')) nav-link-active @endif">
                        <span
                            class="border-leftside @if (Route::is('super_admin.company_pages.*')) border-leftside-active @endif"></span>
                        <i class="fa-solid fa-building icon-size"></i>
                        <span class="text">
                            Company Pages
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if (Route::is('super_admin.pages_contents.*')) nav-link-active @endif d-flex align-items-center justify-content-between"
                        data-toggle="collapse" href="#collapse1010" role="button"
                        aria-expanded="@if (Route::is('super_admin.pages_contents.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse1010">
                        <span
                            class="border-leftside @if (Route::is('super_admin.pages_contents.*')) border-leftside-active @endif"></span>
                        <span><i class="fa-solid fa-gear icon-size"></i> <span>Site Content</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.pages_contents.*')) collapsed show @else collapse @endif"
                        id="collapse1010">







                        <ul class="text-white">

                            <li class="nav-item">
                                <a class="nav-link text-white @if (Route::is('super_admin.pages_contents.*'))  @endif d-flex align-items-center justify-content-between"
                                    data-toggle="collapse" href="#collapse109" role="button"
                                    aria-expanded="@if (Route::is('super_admin.pages_contents.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                                    aria-controls="collapse109">
                                    <span>Sections</span></span>
                                    <i class="fa-solid fa-chevron-down"></i></a>
                                <div class="@if (Route::is('super_admin.pages_contents.*')) collapsed show @else collapse @endif"
                                    id="collapse109">
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'home_page_search') }}"
                                                class="nav-link-sub">Search</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'teacher_mian_category') }}"
                                                class="nav-link-sub">Tutor Main Categories</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'premium_teachers') }}"
                                                class="nav-link-sub">Premium Tutors</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'find_nearest_teachers') }}"
                                                class="nav-link-sub">Nearest Tutors</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'teachers_tabs') }}"
                                                class="nav-link-sub">Tutor Tabs</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'featured_academies') }}"
                                                class="nav-link-sub">Featured Academies</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'free_consultation') }}"
                                                class="nav-link-sub">Free Consultation</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'community_events') }}"
                                                class="nav-link-sub">Community Events</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'testimonials') }}"
                                                class="nav-link-sub">Testimonials</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'app_section') }}"
                                                class="nav-link-sub">App Section</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'faqs_section') }}"
                                                class="nav-link-sub">Faqs Section</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'general') }}"
                                                class="nav-link-sub">General Content</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'footer_section') }}"
                                                class="nav-link-sub">Footer Section</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>



















                        <ul class="text-white">

                            <li class="nav-item">
                                <a class="nav-link text-white @if (Route::is('super_admin.pages_contents.*'))  @endif d-flex align-items-center justify-content-between"
                                    data-toggle="collapse" href="#collapse107" role="button"
                                    aria-expanded="@if (Route::is('super_admin.pages_contents.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                                    aria-controls="collapse107">
                                    <span>Pages</span></span>
                                    <i class="fa-solid fa-chevron-down"></i></a>
                                <div class="@if (Route::is('super_admin.pages_contents.*')) collapsed show @else collapse @endif"
                                    id="collapse107">
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li class="list-style-cicrle"><a
                                                href="{{ route('super_admin.pages_contents.get', 'categories_page') }}"
                                                class="nav-link-sub">Categories Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'teachers_page') }}"
                                                class="nav-link-sub">Tutors Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'academies_page') }}"
                                                class="nav-link-sub">Academies Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'events_page') }}"
                                                class="nav-link-sub">Events Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'faq_page') }}"
                                                class="nav-link-sub">Faqs Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'login_page') }}"
                                                class="nav-link-sub">Login Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'register_page') }}"
                                                class="nav-link-sub">Register Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li class="list-style-cicrle"><a
                                                href="{{ route('super_admin.pages_contents.get', 'contact_page') }}"
                                                class="nav-link-sub">Contact Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li class="list-style-cicrle"><a
                                                href="{{ route('super_admin.pages_contents.get', 'blog_page') }}"
                                                class="nav-link-sub">Blog Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li class="list-style-cicrle"><a
                                                href="{{ route('super_admin.pages_contents.get', 'media_page') }}"
                                                class="nav-link-sub">Media Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li class="list-style-cicrle"><a
                                                href="{{ route('super_admin.pages_contents.get', 'archives_page') }}"
                                                class="nav-link-sub">Courses Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'reset_password_page') }}"
                                                class="nav-link-sub">Reset Password Page</a></li>
                                    </ul>
                                    <ul class="text-white" style="list-style-type: circle">
                                        <li><a href="{{ route('super_admin.pages_contents.get', 'forgot_password_page') }}"
                                                class="nav-link-sub">Forgot Password Page</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>






                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.countries.*') ||
                            Route::is('super_admin.states.*') ||
                            Route::is('super_admin.cities.*') ||
                            Route::is('super_admin.languages.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse105" role="button"
                        aria-expanded="@if (Route::is('super_admin.countries.*') ||
                                Route::is('super_admin.states.*') ||
                                Route::is('super_admin.cities.*') ||
                                Route::is('super_admin.languages.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse105">
                        <span
                            class="border-leftside @if (Route::is('super_admin.countries.*') ||
                                    Route::is('super_admin.states.*') ||
                                    Route::is('super_admin.cities.*') ||
                                    Route::is('super_admin.languages.*')) border-leftside-active @endif"></span>
                        <span><i class="fa-solid fa-gear icon-size"></i> <span class="text">Admin</span></span> <i
                            class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.countries.*') ||
                            Route::is('super_admin.states.*') ||
                            Route::is('super_admin.cities.*') ||
                            Route::is('super_admin.languages.*')) collapsed show @else collapse @endif"
                        id="collapse105">
                        <ul class="text-white">
                            <li><a href="{{ route('super_admin.countries.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.countries.*')) nav-link-sub-active @endif">Countries</a>
                            </li>
                            <li><a href="{{ route('super_admin.states.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.states.*')) nav-link-sub-active @endif">States</a>
                            </li>
                            <li><a href="{{ route('super_admin.cities.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.cities.*')) nav-link-sub-active @endif">Cities</a>
                            </li>
                            <li><a href="{{ route('super_admin.languages.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.languages.*')) nav-link-sub-active @endif">Languages</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.roles.index') }}" class="nav-link @if (Route::is('super_admin.roles.*')) nav-link-active @endif">
                    <span class="shape-1"></span>
                    <span class="shape-2"></span>
                    <i class="fa-solid fa-user-cog icon-size"></i>
                        <span class="text">
                            Roles
                        </span>
                    </a>
                </li> --}}
                <li class="nav-item mb-4">
                    <a class="nav-link d-flex align-items-center justify-content-between @if (Route::is('super_admin.general_settings.*') ||
                            Route::is('super_admin.specific_settings.social_media_settings.*') ||
                            Route::is('super_admin.specific_settings.configurations.*') ||
                            Route::is('super_admin.specific_settings.payment_method_settings.*')) nav-link-active @endif"
                        data-toggle="collapse" href="#collapse102" role="button"
                        aria-expanded="@if (Route::is('super_admin.general_settings.*') ||
                                Route::is('super_admin.specific_settings.social_media_settings.*') ||
                                Route::is('super_admin.specific_settings.configurations.*') ||
                                Route::is('super_admin.specific_settings.payment_method_settings.*')) @php echo 'true' @endphp@else@php echo 'false' @endphp @endif"
                        aria-controls="collapse102">
                        <span
                            class="border-leftside @if (Route::is('super_admin.general_settings.*') ||
                                    Route::is('super_admin.specific_settings.social_media_settings.*') ||
                                    Route::is('super_admin.specific_settings.configurations.*') ||
                                    Route::is('super_admin.specific_settings.payment_method_settings.*')) border-leftside-active @endif"></span>
                        <span><i class="fa-solid fa-question-circle icon-size"></i> <span
                                class="text">Settings</span></span>
                        <i class="fa-solid fa-chevron-down"></i></a>
                    <div class="@if (Route::is('super_admin.general_settings.*') ||
                            Route::is('super_admin.specific_settings.social_media_settings.*') ||
                            Route::is('super_admin.specific_settings.configurations.*') ||
                            Route::is('super_admin.specific_settings.payment_method_settings.*')) collapsed show @else collapse @endif"
                        id="collapse102">
                        <ul class="text-white">

                            <li><a href="{{ route('super_admin.general_settings.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.general_settings.*')) nav-link-sub-active @endif">General
                                    Settings</a>
                            </li>
                            <li><a href="{{ route('super_admin.specific_settings.configurations') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.specific_settings.configurations.*')) nav-link-sub-active @endif">Configuration
                                    Settings</a>
                            </li>
                            <li><a href="{{ route('super_admin.specific_settings.social_media_settings') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.specific_settings.social_media_settings.*')) nav-link-sub-active @endif">
                                    Social media Settings</a></li>
                                    <li><a href="{{ route('super_admin.notification_settings.index') }}"
                                        class="nav-link-sub @if (Route::is('super_admin.notification_settings.*')) nav-link-sub-active @endif">Notification
                                        Settings</a>
                                </li>
                            <li><a href="{{ route('super_admin.specific_settings.payment_method_settings') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.specific_settings.payment_method_settings.*')) nav-link-sub-active @endif">
                                    Subscription Method Settings</a></li>
                            <li><a href="{{ route('super_admin.version_upgrade.index') }}"
                                    class="nav-link-sub @if (Route::is('super_admin.version_upgrade.*')) nav-link-sub-active @endif">Version
                                    Upgrade</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if ($general_settings['commission_type'] == 'subscription_base')
                    <li>
                        <a href="{{ route('super_admin.specific_settings.payment_method_settings') }}"
                            class="nav-link-sub @if (Route::is('super_admin.specific_settings.payment_method_settings.*')) nav-link-sub-active @endif">
                            Subscription Method Settings</a>
                    </li>
                @endif

                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.general_settings.index') }}"
                        class="nav-link @if (Route::is('super_admin.general_settings.index')) nav-link-active @endif">

                        <i class="fa-solid fa-tools icon-size"></i>
                        <span class="text">
                            General Settings
                        </span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.specific_settings.social_media_settings') }}"
                        class="nav-link @if (Route::is('super_admin.specific_settings.social_media_settings')) nav-link-active @endif">

                        <i class="fa-solid fa-tools icon-size"></i>
                        <span class="text">
                            Social media Settings
                        </span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.specific_settings.configurations') }}"
                        class="nav-link @if (Route::is('super_admin.specific_settings.configurations')) nav-link-active @endif">

                        <i class="fa-solid fa-tools icon-size"></i>
                        <span class="text">
                            Configuration Settings
                        </span>
                    </a>
                </li> --}}
                <!-- <li class="nav-item">
                    <a href="{{ route('super_admin.specific_settings.footer_settings') }}"
                        class="nav-link @if (Route::is('super_admin.specific_settings.footer_settings')) nav-link-active @endif">

                        <i class="fa-solid fa-tools icon-size"></i>
                        <span class="text">
                            Footer Settings
                        </span>
                    </a>
                </li> -->
                {{-- <li class="nav-item">
                    <a href="{{ route('super_admin.specific_settings.home_page_statistics_settings') }}" class="nav-link @if (Route::is('super_admin.specific_settings.home_page_statistics_settings')) nav-link-active @endif">
                    <span class="shape-1"></span>
                    <span class="shape-2"></span>
                    <i class="fa-solid fa-tools icon-size"></i>
                        <span class="text">
                            Home Page Statistics Settings
                        </span>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
