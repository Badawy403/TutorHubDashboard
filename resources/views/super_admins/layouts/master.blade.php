@include('super_admins.includes.head')
@php
     $site_logo = App\Models\GeneralSetting::where('name', 'logo')->first();
@endphp
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center" style="background:white;">
<img class="animation__shake" src="{{ $site_logo && $site_logo->value ? asset($site_logo->value) : asset('images/logo.png') }}" alt="Consultant" height="80">
</div>
@include('super_admins.includes.navbar')
@include('super_admins.includes.sidebar')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper p-lg-4">
     @yield('content')
</div>
@include('super_admins.includes.footer')
@include('super_admins.includes.foot')
